<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

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
        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-food-form');
        } else {
            return view('login.access-denied');
        }
    }

    public function addMenuFormIndex(AdminController $adminController)
    {

        $food = Food::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('menu.add-menu-form', ['listItems' => $food]);
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

        return redirect('/add-food');
    }


    // Update function 
    public function update()
    {

        $food = Food::find(1);

        $food->topic = "Laravel";

        $food->save();

        echo "Update Successful!";
    }

    // Delete function 
    public function delete()
    {

        $food = Food::find(1);

        $food->delete();

        echo "Delete Successful!";
    }
}
