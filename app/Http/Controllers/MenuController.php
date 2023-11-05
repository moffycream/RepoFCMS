<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuFood;
use App\Models\Inventory;
use App\Models\Food;
use App\http\Controllers\AdminController;
use App\Http\Controllers\ValidationController;

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

    //Add menu form
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

    // Register new menu 
    public function registerNewMenu(Request $request)
    {
        $validator = app(ValidationController::class);

        $imageErrMsg = "";
        $nameErrMsg = "";
        $checkboxErrMsg = "";

        $menu = new Menu();
        $menu->menuID = $request->menuID;

        //Image
        if ($request->hasFile('image')) {
            $fileName = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('', $fileName, 'addFood');
            $menu->imagePath = 'food-images/' . $path;
        } else {
            $imageErrMsg .= "The image field is required.";
        }

        //Name
        if ($request->filled('name')) {
            if ($validator->validateText($request->name, '/^.{0,20}$/')) {
                $menu->name = $request->name;
            } else {
                $nameErrMsg .= "The name must be less than 20 characters.";
            }
        } else {
            $nameErrMsg .= "The name field is required.";
        }

        //Checkboxes
        if ($request->totalPrice == 0) {
            $checkboxErrMsg .= "Please select at least one food item.";
        } else {
            $menu->totalPrice = $request->totalPrice;
        }

        $menus = Menu::all();
        $foods = Food::all();
        $inventories = Inventory::all();

        if ($imageErrMsg == "" && $nameErrMsg == "" && $checkboxErrMsg == "") {
            $menu->save();

            $array = $request->selectedFoodIDs;
            $menuFoodController = new MenuFoodController();

            foreach ($array as $foodID) {
                // Call the registerNewMenuFood method for each food item
                $menuFoodController->registerNewMenuFood($request, $menu->menuID, $foodID);
            }

            return redirect('/add-menu')->with(['listItems' => $menus, 'inventories' => $inventories, 'foods' => $foods]);
        } else {
            return view('menu.add-menu-form')->with(['listItems' => $foods, 'inventory' => $inventories])
                ->with('imageErrMsg', $imageErrMsg)
                ->with('nameErrMsg', $nameErrMsg)
                ->with('checkboxErrMsg', $checkboxErrMsg)
                ->with('name', $request->name);
        }
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

    // Delete menu
    public function deleteMenu($menuID)
    {
        Menu::find($menuID)->delete();

        return redirect('/add-menu');
    }
}
