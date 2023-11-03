<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\FoodInventory;

class InventoryController extends Controller
{
    protected $adminController;

    // Retrieve function 
    public function index(AdminController $adminController)
    {
        $inventory = Inventory::all();
        $foodInventory = FoodInventory::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.inventory-management', ['listItems' => $inventory, 'foodInventory' => $foodInventory]);
        } else {
            return view('login.access-denied');
        }
    }

    // Register new inventory
    public function registerNewInventory(Request $request)
    {
        $inventory = new Inventory();

        //Store image path, name total price to database
        $inventory->inventoryName = $request->name;
        $inventory->amount = $request->amount;
        $inventory->save();

        // foreach ($array as $foodID) {
        //     // Call the registerNewMenuFood method for each food item
        //     $menuFoodController->registerNewMenuFood($request, $menu->menuID, $foodID);
        // }

        return redirect('/inventory-management');
    }

    //  Edit inventory
    public function editInventory(Request $request)
    {
        $inventory = Inventory::find($request->inventoryID);

        $inventory->inventoryName = $request->name;
        $inventory->amount = $request->amount;
        $inventory->save();

        return redirect('/inventory-management');
    }

    //  Delete inventory
    public function deleteInventory($inventoryID)
    {
        Inventory::find($inventoryID)->delete();

        return redirect('/inventory-management');
    }
}
