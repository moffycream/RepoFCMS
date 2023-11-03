<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\FoodInventory;
use App\Models\Inventory;

class FoodController extends Controller
{
    // used for verification
    protected $adminController;

    // Retrieve function 
    public function index(AdminController $adminController)
    {
        $food = Food::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-food', ['listItems' => $food]);
        } else {
            return view('login.access-denied');
        }
    }

    public function addFoodForm(AdminController $adminController)
    {
        $inventory = Inventory::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-food-form', ['listItems' => $inventory]);
        } else {
            return view('login.access-denied');
        }
    }

    public function addMenuFormIndex(AdminController $adminController)
    {

        $food = Food::all();
        $inventory = Inventory::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-menu-form', ['listItems' => $food, 'inventory' => $inventory]);
        } else {
            return view('login.access-denied');
        }
    }

    // Insert function 
    public function registerNewFood(Request $request)
    {
        $food = new Food();
        $food->foodID = $request->foodID;

        $fileName = time() . $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('', $fileName, 'addFood');

        $food->imagePath = 'food-images/' . $path;
        $food->name = $request->name;
        $food->description = $request->description;
        $food->price = $request->price;
        $food->save();

        $inventoryIDs = $request->inventoryID;
        $amounts = $request->amount;
        $inventoryData = array_combine($inventoryIDs, $amounts);

        $foodInventoryController = new FoodInventoryController();

        foreach ($inventoryData as $inventoryID => $amount) {
            $foodInventoryController->registerNewFoodInventory($request, $food->foodID, $inventoryID, $amount);
        }

        return redirect('/add-food');
    }

    public function editFood(AdminController $adminController, Request $request)
    {
        // Checks whether is valid login or not
        $this->adminController = $adminController;
        $food = Food::all();

        // Redirect to another page with the food ID
        if ($this->adminController->verifyAdmin()) {
            return view('menu.edit-food', ['foodID' => $request->foodID], ['listItems' => $food]);
        } else {
            return view('login.access-denied');
        }
    }

    //  Delete Food
    public function deleteFood($foodID)
    {
        Food::find($foodID)->delete();

        return redirect('/add-food');
    }
}
