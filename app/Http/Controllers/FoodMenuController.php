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
}
