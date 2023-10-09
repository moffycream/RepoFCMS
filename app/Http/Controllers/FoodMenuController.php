<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Food;

class FoodMenuController extends Controller
{
    public function index()
    {
        // Retrieve data from the database
        $menus = Menu::all();
        $foods = Food::all();

        return view('food-menu', compact('menus', 'foods'));
    }

    public function addToCart(Request $request)
    {
    // Retrieve the menu item's ID from the form submission
    $menuId = $request->input('menu_id');

    // Initialize the cart session variable if it doesn't exist
    $cart = $request->session()->get('cart', []);

    // Add the menu item's ID to the cart array
    $cart[] = $menuId;

    // Update the cart session variable with the new data
    $request->session()->put('cart', $cart);

    // Redirect back to the menu page or wherever you prefer
    return redirect()->route('menu.index')->with('success', 'Item added to cart');
    }
}
