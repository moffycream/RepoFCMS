<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuFood;
use App\Models\Inventory;
use App\Models\Food;
use App\http\Controllers\AdminController;

class MenuController extends Controller
{
    protected $adminController;
    // Retrieve data 
    public function index(AdminController $adminController)
    {
        $menu = Menu::all();
        $inventory = Inventory::all();
        $food = Food::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-menu', ['listItems' => $menu, 'inventories' => $inventory, 'foods' => $food]);
        } else {
            return view('login.access-denied');
        }
    }

    // Register new menu 
    public function registerNewMenu(Request $request)
    {
        $menu = new Menu();
        $menu->menuID = $request->menuID;

        //Set image file name and path
        $fileName = time() . $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('', $fileName, 'addMenu');

        //Store image path, name total price to database
        $menu->imagePath = 'menu-images/' . $path;
        $menu->name = $request->name;
        $menu->totalPrice = $request->totalPrice;
        $menu->save();

        $array = $request->selectedFoodIDs;
        $menuFoodController = new MenuFoodController();

        foreach ($array as $foodID) {
            // Call the registerNewMenuFood method for each food item
            $menuFoodController->registerNewMenuFood($request, $menu->menuID, $foodID);
        }

        return redirect('/add-menu');
    }

    // Edit menu
    public function editMenu(Request $request)
    {
        $menu = Menu::find($request->menuID);

        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('', $fileName, 'addMenu');
            $menu->imagePath = 'menu-images/' . $path;
        }

        $menu->name = $request->name;

        // Delete all menu food
        $menuFood = MenuFood::where('menuID', $request->menuID)->get();
        foreach ($menuFood as $food) {
            $food->delete();
        }

        //  Recreate all menu food
        $array = $request->foodID;
        $menuFoodController = new MenuFoodController();

        $newTotalPrice = 0;

        foreach ($array as $foodID) {
           // Call the registerNewMenuFood method for each food item
           $menuFoodController->registerNewMenuFood($request, $menu->menuID, $foodID);

           // Update total price
           $newFood = Food::find($foodID);
           $newTotalPrice += $newFood->price;
        }

        $menu->totalPrice = $newTotalPrice;
        $menu->save();


        return redirect('/add-menu');
    }
}
