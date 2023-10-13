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


    public function addToCart(Request $request, Menu $menu)
        {
            // Check if the menu item already exists in the cart.
            $cart = session()->get('cart', []);
            
            if (array_key_exists($menu->id, $cart)) 
            {
                // If it exists, increase the quantity by 1.
                $cart[$menu->id]['quantity'] += 1;
            } 
            else 
            {
                // If it doesn't exist, add it to the cart with a quantity of 1.
                $cart[$menu->id] = [
                    'menu' => $menu->name,
                    'quantity' => 1,
                ];
            }

            // Store the updated cart in the session.
            session()->put('cart', $cart);

            // Optionally, you can redirect the user back to the menu page or to the cart page.
            return redirect()->route('menu.index');
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
