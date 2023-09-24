<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem; // include the model

class TodoListController extends Controller
{
    public function index()
    {
        // Return the "welcome" view, passing an array with the list of items to the view
        // Retrieve all items from the 'list_items' database table
        // and assign them to the 'listItems' variable in the view
        return view('welcome', ['listItems' => ListItem::all()]);
    }
    

    public function saveItem(Request $request)
    {
        $item = new ListItem;
        $item->name = $request->name;
        $item->is_complete = 0; // set it false
        $item->save();

        return redirect('/');
    }

    public function markItem($id) 
{
    $item = ListItem::find($id);
    $item->is_complete = 1;
    $item->save();
    return redirect('/');
}
}
