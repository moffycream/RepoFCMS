<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuFood;
use App\Models\Inventory;
use App\http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;

class MenuController extends Controller
{
    protected $adminController;
    // Retrieve data 
    public function index(AdminController $adminController)
    {
        $notificationController = app(NotificationController::class);
        $menu = Menu::all();
        $inventory = Inventory::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) 
        {
            return view('menu.add-menu', ['listItems' => $menu, 'inventories' => $inventory]);
        }
        else
        {
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
}
