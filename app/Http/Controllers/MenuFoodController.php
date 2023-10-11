<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuFood;
use App\Http\Controllers\AdminController;

class MenuFoodController extends Controller
{
    // used for verification
    protected $adminController;

    // Register new menu food record in MenuFood database 
    public function registerNewMenuFood(Request $request, $menuID, $foodID)
    {
        $menuFood = new MenuFood();
        $menuFood->id = $request->id;
        $menuFood->menuID = $menuID;
        $menuFood->foodID = $foodID;
        $menuFood->save();
    }
}
