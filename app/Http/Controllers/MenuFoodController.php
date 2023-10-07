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

        return view('add-menu-form', ['listItems' => $menuFood]);
    }

    // Insert function 
    public function registerNewMenuFood(Request $request)
    {
        $menuFood = new MenuFood();
        $menuFood->id = $request->id;
        $menuFood->menuID = $request->menuID;
        $menuFood->foodID = $request->foodID;
        $menuFood->save();

        return redirect('/add-menu');
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
