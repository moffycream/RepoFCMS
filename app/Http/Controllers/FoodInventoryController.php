<?php

namespace App\Http\Controllers;

use App\Models\FoodInventory;
use Illuminate\Http\Request;

class FoodInventoryController extends Controller
{
        // Register new menu food record in MenuFood database 
        public function registerNewFoodInventory(Request $request, $foodID, $inventoryID, $amount)
        {
            $foodInventory = new FoodInventory();
            $foodInventory->id = $request->id;
            $foodInventory->foodID = $foodID;
            $foodInventory->inventoryID = $inventoryID;
            $foodInventory->amount = $amount;
            $foodInventory->save();
        }
}
