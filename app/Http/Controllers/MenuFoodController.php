<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuFood;

class MenuFoodController extends Controller
{
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
