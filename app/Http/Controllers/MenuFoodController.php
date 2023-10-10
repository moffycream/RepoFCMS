<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuFood;
use App\Http\Controllers\AdminController;

class MenuFoodController extends Controller
{
    // used for verification
    protected $adminController;

    // Retrieve function 
    public function index(AdminController $adminController)
    {

        $menuFood = MenuFood::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('add-menu', ['listItems' => $menuFood]);
        } else {
            return view('login.access-denied');
        }
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
