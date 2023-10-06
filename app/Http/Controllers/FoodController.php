<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    // Retrieve function 
    public function index() { 

        $food = Food::all(); 

        return view('add-food', ['listItems' => $food]);
    } 

    // Insert function 
    public function registerNewFood(Request $request) { 
    $food = new Food(); 
    $food->foodID = $request->foodID;
    $fileName = time().$request->file('image')->getClientOriginalName();
    $path = $request->file('image')->storeAs('', $fileName, 'addFood');

    $food->imagePath = 'food-images/'.$path;
    $food->name = $request->name;
    $food->description = $request->description;
    $food->price = $request->price;
    $food->save();

    return redirect('/add-food');
} 
    // Update function 
    public function update() { 

        $food = Food::find(1); 

        $food->topic = "Laravel"; 

        $food->save(); 

        echo "Update Successful!"; 

    } 

    // Delete function 
    public function delete() { 

        $food = Food::find(1); 

        $food->delete(); 

        echo "Delete Successful!"; 

    }
}