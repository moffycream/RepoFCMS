<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // Retrieve function 
    public function index() { 

        $menu = Menu::all(); 

        return view('add-menu', ['listItems' => $menu]);
    } 

    // Insert function 
    public function registerNewMenu(Request $request) { 
    $menu = new Menu(); 
    $menu->foodID = $request->foodID;
    $menu->totalPrice = $request->totalPrice;
    $menu->save();

    return redirect('/register-success');
} 

    // Update function 
    public function update() { 

        $menu = Menu::find(1); 

        $menu->topic = "Laravel"; 

        $menu->save(); 

        echo "Update Successful!"; 

    } 

    // Delete function 
    public function delete() { 

        $menu = Menu::find(1); 

        $menu->delete(); 

        echo "Delete Successful!"; 

    }
}