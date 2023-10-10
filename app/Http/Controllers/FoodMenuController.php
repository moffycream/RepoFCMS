<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Food;
use App\Http\Controllers\AdminController;

class FoodMenuController extends Controller
{
    // used for verification
    protected $adminController;
    public function index(AdminController $adminController)
    {
        // Retrieve data from the database
        $menus = Menu::all();
        $foods = Food::all();

        // Checks whether is admin session or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('food-menu', compact('menus', 'foods'));
        } else {
            return view('login.access-denied');
        }
    }

    public function addToCart(Request $request)
    {
        // Retrieve the menu item's ID from the form submission
        $menu = $request->input('menu');

        // Initialize the cart session variable if it doesn't exist
        $cart = $request->session()->get('cart', []);

        // Add the menu item's ID to the cart array
        $cart[] = $menu;

        // Update the cart session variable with the new data
        $request->session()->put('cart', $cart);

        // Redirect back to the menu page or wherever you prefer
        return redirect()->route('menu.index')->with('success', 'Item added to cart');
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
