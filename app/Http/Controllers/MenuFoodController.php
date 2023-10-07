<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuFood;

class MenuFoodController extends Controller
{
    // Retrieve function 
    public function index()
    {

        $menuFood = MenuFood::all();

        return view('add-menu', ['listItems' => $menuFood]);
    }

    // Insert function 
    public function registerNewMenuFood(Request $request, $menuID, $foodID)
    {
        $menuFood = new MenuFood();
        $menuFood->id = $request->id;
        $menuFood->menuID = $menuID;
        $menuFood->foodID = $foodID;
        $menuFood->save();
    }

    // Update function 
    public function update()
    {

        $menu = MenuFood::find(1);

        $menu->topic = "Laravel";

        $menu->save();

        echo "Update Successful!";
    }

    // Delete function 
    public function delete()
    {

        $menu = MenuFood::find(1);

        $menu->delete();

        echo "Delete Successful!";
    }
}
