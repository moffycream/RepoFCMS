<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuFood;
use App\http\Controllers\AdminController;

class MenuController extends Controller
{
    protected $adminController;
    // Retrieve function 
    public function index(AdminController $adminController)
    {
        $menu = Menu::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) 
        {
            return view('menu.add-menu', ['listItems' => $menu]);
        }
        else
        {
            return view('login.access-denied');
        }
    }
    public function displayMenu(AdminController $adminController)
    {
        $menu = Menu::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;
        
        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-menu', ['listItems' => $menu]);
        } else {
            return view('login.access-denied');
        }
    }


    // Insert function 
    public function registerNewMenu(Request $request)
    {
        $menu = new Menu();
        $menu->menuID = $request->menuID;

        $fileName = time() . $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('', $fileName, 'addMenu');

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

    // Update function 
    public function update()
    {

        $menu = Menu::find(1);

        $menu->topic = "Laravel";

        $menu->save();

        echo "Update Successful!";
    }

    // Delete function 
    public function delete()
    {

        $menu = Menu::find(1);

        $menu->delete();

        echo "Delete Successful!";
    }
}
