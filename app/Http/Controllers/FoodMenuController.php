<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Menu;
use App\Models\Food;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Models\Order;
use App\Models\Inventory;


class FoodMenuController extends Controller
{
    // used for verification
    protected $adminController;
    public function index(AdminController $adminController)
    {
        // Retrieve data from the database
        $menus = Menu::all();
        $foods = Food::all();
        $inventories = Inventory::all();

        // Retrieve the cart items from the session
        $cart = session('cart', []);

        $totalPrice = $this->showCart();

        // Checks whether it's an admin session or not
        $this->adminController = $adminController;

        return view('food-menu', compact('menus', 'foods', 'cart', 'totalPrice'), [ 'inventories' => $inventories]);
    }

    public function addToCart(Request $request)
    {
        $menu = Menu::find($request->menu_id);

        if (!$menu) 
        {
            return redirect()->route('food-menu.index')->with('error', 'Menu not found.');
        }

        // Get the cart items from the session
        $cart = session('cart', []);

        // Check if the menu item is already in the cart
        $existingItemKey = collect($cart)->search(function ($item) use ($menu) 
        {
            return $item['menu']->menuID === $menu->menuID;
        });

        $stock = $request->input('stock'); // Available stock

        if ($existingItemKey !== false) 
        {
            // If the menu item is in the cart, check if stock allows increment
            if ($cart[$existingItemKey]['quantity'] < $stock) 
            {
                $cart[$existingItemKey]['quantity'] += 1;

                // Decrease available stock
                $stock -= 1;
            } 
            else 
            {
                // Stock is exhausted; you can show an error message here
            }
        } 
        else 
        {
            // If the menu item is not in the cart, add it
            if ($stock > 0) 
            {
                $cart[] = [
                    'menu' => $menu,
                    'quantity' => 1,
                    'price' => $menu->totalPrice // Store the price
                ];

                // Decrease available stock
                $stock -= 1;
            } 
            else 
            {
                // Stock is exhausted; you can show an error message here
            }
        }

        // Store the updated cart and available stock in the session
        session(['cart' => $cart]);

        return redirect()->route('food-menu.index')->with('success', 'Menu item added to cart.');
    }


    public function updateCart(Request $request)
    {
        $menu = Menu::find($request->menu_id);
        $action = $request->input('action');

        Log::info('Updating cart for menuID: ' . $menu . ', action: ' . $action);

        // Retrieve the cart items from the session
        $cart = session('cart', []);

        // Find the item in the cart
        $cartItemIndex = collect($cart)->search(function ($item) use ($menu) 
        {
            return $item['menu']->menuID === $menu-> menuID;
        });

        $stock = $request->input('stock');

        if ($cartItemIndex !== false) 
        {
            // Update the quantity based on the action
            if ($action === 'increment') 
            {
                $cart[$cartItemIndex]['quantity'] += 1;
            }
            elseif ($action === 'decrement') 
            {
                if($cart[$cartItemIndex]['quantity'] > 1)
                {
                    $cart[$cartItemIndex]['quantity'] -= 1;
                    $stock -= 1;
                }
                elseif($cart[$cartItemIndex]['quantity'] === 1)
                {
                    array_splice($cart, $cartItemIndex, 1);
                    $stock += 1;
                    session(['cart' => $cart]);
                }
            }

            // Update the session with the modified cart
            session(['cart' => $cart]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in the cart']);
    }

    public function removeFromCart(Request $request)
    {
        $menu = Menu::find($request->menu_id);

        Log::info('Removing item from cart for menuID: ' . $menu);

        // Retrieve the cart items from the session
        $cart = session('cart', []);

        // Find the item in the cart
        $cartItemIndex = collect($cart)->search(function ($item) use ($menu) 
        {
            return $item['menu']->menuID === $menu->menuID;
        });

        if ($cartItemIndex !== false) 
        {
            // Remove the item from the cart
            array_splice($cart, $cartItemIndex, 1);

            // Update the session with the modified cart
            session(['cart' => $cart]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found in the cart.']);
    }

    public function showCart()
    {
        $cart = session('cart', []);

        // Calculate the total price by iterating through the cart items
        $totalPrice = 0;
        foreach ($cart as $item) 
        {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return $totalPrice;
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

        if (!$selectedOrder) 
        {
            return redirect()->route('food-menu.index')->with('error', 'Order not found.');
        }

        // Initialize the cart
        $cart = session('cart', []);

        // Iterate through the items in the selected order
        foreach ($selectedOrder->menus as $menu) 
        {
            // Check if the menu item is already in the cart
            $existingItemKey = collect($cart)->search(function ($item) use ($menu) 
            {
                return $item['menu']->menuID === $menu->menuID;
            });

            if ($existingItemKey !== false) 
            {
                // If the menu item is in the cart, increment the quantity
                $cart[$existingItemKey]['quantity'] += 1;
            } 
            else 
            {
                // If the menu item is not in the cart, add it
                $cart[] = 
                [
                    'menu' => $menu,
                    'quantity' => 1,
                    'price' => $menu->totalPrice,
                ];
            }
        }

        // Store the updated cart in the session
        session(['cart' => $cart]);

        // Redirect to the menu page or any other page you prefer
        return redirect()->route('food-menu.index')->with('success', 'Menu items added to cart.');
    }
}
