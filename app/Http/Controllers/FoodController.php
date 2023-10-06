<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    // Retrieve function 
    public function index() { 

        $menu = Food::all(); 

        return view('add-menu', ['listItems' => $menu]);
    } 

    // Insert function 
    public function registerNewFood(Request $request) { 
    $menu = new Food(); 
    $menu->foodID = $request->foodID;
    $menu->image = $request->image;
    $menu->name = $request->name;
    $menu->description = $request->description;
    $menu->price = $request->price;
    $menu->save();

    return redirect('/register-success');
} 

    // Update function 
    public function update() { 

        $menu = Food::find(1); 

        $menu->topic = "Laravel"; 

        $menu->save(); 

        echo "Update Successful!"; 

    } 

    // Delete function 
    public function delete() { 

        $menu = Food::find(1); 

        $menu->delete(); 

        echo "Delete Successful!"; 

    }
}