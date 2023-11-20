<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\FoodInventory;
use App\Http\Controllers\ValidationController;

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
        $validator = app(ValidationController::class);

        $nameErrMsg = "";
        $amountErrMsg = "";

        $inventory = new Inventory();
        $inventory->inventoryID = $request->inventoryID;

        // Validate name
        if ($request->filled('name')) {
            if ($validator->validateText($request->name, '/^.{0,20}$/')) {
                $inventory->inventoryName = $request->name;
            } else {
                $nameErrMsg .= "The name must be less than 20 characters.";
            }
        } else {
            $nameErrMsg = "Please enter a name";
        }

        // Validate amount
        if ($request->filled('amount')) {
            if ($validator->validateText($request->amount, '/^[0-9]{1,10}$/')) {
                $inventory->amount = $request->amount;
            } else {
                $amountErrMsg .= "The amount must be less than 10 digits.";
            }
        } else {
            $amountErrMsg = "Please enter an amount";
        }

        $inventories = Inventory::all();
        $foodInventories = FoodInventory::all();

        if ($nameErrMsg == "" && $amountErrMsg == "") {
            //Store image path, name total price to database
            $inventory->save();
            return redirect('/inventory-management')->with(['listItems' => $inventories, 'foodInventory' => $foodInventories]);
        } else {
            return view('menu.inventory-management', ['listItems' => $inventories, 'foodInventory' => $foodInventories, 'name' => $request->name, 'amount' => $request->amount, 'nameErrMsg' => $nameErrMsg, 'amountErrMsg' => $amountErrMsg]);
        }
    }

    //  Edit inventory
    public function editInventory(Request $request)
    {
        $inventory = Inventory::find($request->inventoryID);

        $validator = app(ValidationController::class);

        $nameErrMsg = "";
        $amountErrMsg = "";

        // Validate name
        if ($request->filled('name')) {
            if ($validator->validateText($request->name, '/^.{0,20}$/')) {
                $inventory->inventoryName = $request->name;
            } else {
                $nameErrMsg .= "The name must be less than 20 characters.";
            }
        } else {
            $nameErrMsg = "Please enter a name";
        }

        // Validate amount
        if ($request->filled('amount')) {
            if ($validator->validateText($request->amount, '/^[0-9]{1,10}$/')) {
                $inventory->amount = $request->amount;
            } else {
                $amountErrMsg .= "The amount must be less than 10 digits.";
            }
        } else {
            $amountErrMsg = "Please enter an amount";
        }

        $inventories = Inventory::all();
        $foodInventories = FoodInventory::all();

        if ($nameErrMsg == "" && $amountErrMsg == "") {
            //Store image path, name total price to database
            $inventory->save();
            return redirect('/inventory-management')->with(['listItems' => $inventories, 'foodInventory' => $foodInventories]);
        } else {
            return view('menu.inventory-management', ['listItems' => $inventories, 'foodInventory' => $foodInventories, 'editName' => $request->name, 'editAmount' => $request->amount, 'editNameErrMsg' => $nameErrMsg, 'editAmountErrMsg' => $amountErrMsg]);
        }
    }

    // Unarchive inventory
    public function unarchiveInventory($inventoryID)
    {
        $inventory = Inventory::find($inventoryID);
        $inventory->isArchive = false;
        $inventory->save();

        $inventories = Inventory::all();
        $foodInventories = FoodInventory::all();

        return view('menu.inventory-management', ['listItems' => $inventories, 'foodInventory' => $foodInventories]);
    }

    //  Archive inventory
    public function archiveInventory($inventoryID)
    {
        $inventory = Inventory::find($inventoryID);
        $inventory->isArchive = true;
        $inventory->save();

        $inventories = Inventory::all();
        $foodInventories = FoodInventory::all();

        return view('menu.inventory-management', ['listItems' => $inventories, 'foodInventory' => $foodInventories]);
    }

    //  Delete inventory
    public function deleteInventory($inventoryID)
    {
        Inventory::find($inventoryID)->delete();
        $inventories = Inventory::all();
        $foodInventories = FoodInventory::all();

        return view('menu.inventory-management', ['listItems' => $inventories, 'foodInventory' => $foodInventories]);
    }
}
