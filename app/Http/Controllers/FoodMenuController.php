<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Food;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;

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

        if ($this->adminController->verifyAdmin()) 
        {
            return view('food-menu', compact('menus', 'foods', 'cart'), ['notifications' => $notificationController->getNotification()]);
        } else 
        {
            return view('login.access-denied');
        }
    }
    
    public function addToCart(Request $request)
    {
        $menu = Menu::find($request->menu_id);

        if (!$menu) 
        {
            return redirect()->route('menu.index')->with('error', 'Menu not found.');
        }

        // Get the cart items from the session
        $cart = session('cart', []);

        // Check if the menu item is already in the cart
        $existingItem = collect($cart)->first(function ($item) use ($menu) 
        {
            return $item['menu']->id === $menu->id;
        });

        if ($existingItem) 
        {
            $existingItem['quantity'] += 1;
        } 
        else 
        {
            // If the menu item is not in the cart, add it
            $cart[] = ['menu' => $menu, 'quantity' => 1];
        }

    // Store the updated cart in the session
    session(['cart' => $cart]);

    return redirect()->route('food-menu.index')->with('success', 'Menu item added to cart.');
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

        // Perform the checkout process (e.g., create an order in the database)

        // Clear the cart after checkout
        $request->session()->forget('cart');

        // Redirect to a confirmation page or wherever you prefer
        return redirect()->route('purchase.index')->with('success', 'Checkout successful');
    }
}
