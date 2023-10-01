<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\test;  <-- test

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){return view('welcome');});

// Route for the main page (GET request)
// When a user accesses the root URL ('/'), the 'index' method of 'TodoListController' is invoked.
//Route::get('/', [TodoListController::class, 'index']);

// Route for saving a new item (POST request)
// When a user submits a form to save an item, this route triggers the 'saveItem' method of 'TodoListController'.
// It is also given the name 'saveItem' for easy route referencing.
//Route::post('/saveItem', [TodoListController::class, 'saveItem'])->name('saveItem');

// Route for marking an item as complete (POST request with parameter)
// When a user submits a form to mark an item as complete, this route triggers the 'markItem' method of 'TodoListController'.
// It is also given the name 'markAsComplete' for easy route referencing.
// Note that this route includes a parameter 'id' in the URL to specify which item to mark as complete.
//Route::post('/markAsComplete/{id}', [TodoListController::class, 'markItem'])->name('markAsComplete');


// Route::get('/', [test::class, 'SampleMethod']);