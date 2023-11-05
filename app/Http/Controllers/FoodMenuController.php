<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Food;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Models\Order;


class FoodMenuController extends Controller
{
    // used for verification
    protected $adminController;
    public function index(AdminController $adminController)
    {
        // Retrieve data from the database
        $menus = Menu::all();
        $foods = Food::all();

        // Retrieve the cart items from the session
        $cart = session('cart', []);

        $notificationController = app(NotificationController::class);

        // Checks whether it's an admin session or not
        $this->adminController = $adminController;


        return view('food-menu', compact('menus', 'foods', 'cart'), ['notifications' => $notificationController->getNotification()]);
    }

    public function addToCart(Request $request)
    {
        $menu = Menu::find($request->menu_id);

        if (!$menu) {
            return redirect()->route('menu.index')->with('error', 'Menu not found.');
        }
        // Get the cart items from the session
        $cart = session('cart', []);

        // Check if the menu item is already in the cart
        $existingItemKey = collect($cart)->search(function ($item) use ($menu) {
            return $item['menu']->menuID === $menu->menuID;
        });

        if ($existingItemKey !== false) {
            // If the menu item is in the cart, increment the quantity
            $cart[$existingItemKey]['quantity'] += 1;
        } else {
            // If the menu item is not in the cart, add it
            $cart[] = [
                'menu' => $menu,
                'quantity' => 1,
                'price' => $menu->totalPrice // Store the price
            ];
        }

        // Store the updated cart in the session
        session(['cart' => $cart]);

        return redirect()->route('menu.index')->with('success', 'Menu item added to cart.');
    }

    public function showCart()
    {
        $cart = session('cart', []);
        return view('cart.index', ['cart' => $cart]);
    }

    public function checkout(Request $request)
    {
        // Retrieve the user's cart from the session
        $cart = $request->session()->get('cart', []);

        // Clear the cart after checkout
        $request->session()->forget('cart');

        // Retrieve notifications
        $notificationController = app(NotificationController::class);
        $notifications = $notificationController->getNotification();

        // Pass the cart and notifications to the 'purchase' view
        return view('purchase', ['cart' => $cart, 'notifications' => $notifications])->with('success', 'Checkout successful');
    }

    // use for customer order history details
    public function orderAgain($orderID)
    {
        // Retrieve the selected order
        $selectedOrder = Order::find($orderID);

        if (!$selectedOrder) {
            return redirect()->route('menu.index')->with('error', 'Order not found.');
        }

        // Initialize the cart
        $cart = session('cart', []);

        // Iterate through the items in the selected order
        foreach ($selectedOrder->menus as $menu) {
            // Check if the menu item is already in the cart
            $existingItemKey = collect($cart)->search(function ($item) use ($menu) {
                return $item['menu']->menuID === $menu->menuID;
            });

            if ($existingItemKey !== false) {
                // If the menu item is in the cart, increment the quantity
                $cart[$existingItemKey]['quantity'] += 1;
            } else {
                // If the menu item is not in the cart, add it
                $cart[] = [
                    'menu' => $menu,
                    'quantity' => 1,
                    'price' => $menu->totalPrice,
                ];
            }
        }

        // Store the updated cart in the session
        session(['cart' => $cart]);

        // Redirect to the menu page or any other page you prefer
        return redirect()->route('menu.index')->with('success', 'Menu items added to cart.');
    }
}
