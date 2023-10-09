<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuFoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderListingController;
use App\Http\Controllers\PaymentController;

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

// Homepage links
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);

// Customer profile
Route::get('/profile',[ProfileController::class, 'index']);
Route::post('/customer-orders-listings/{orderID}', [OrderListingController::class, 'viewOrderDetails'])->name('customer-orders-listings');

// Login and register
Route::get('/login', [UserAccountController::class, 'index']);
Route::post('/login', [LoginController::class, 'index'])->name('user.login');
Route::get('/register', [UserAccountController::class, 'register']);
Route::post('/register', [UserAccountController::class, 'registerNewAccount'])->name('user.register');
Route::get('/register/register-success', [UserAccountController::class, 'registerSuccess']);

// Menu - client side
Route::get('/menu', [MenuController::class, 'index']);

// Menu - management side
Route::get('/add-food', [FoodController::class, 'index']);
Route::post('/add-food', [FoodController::class, 'registerNewFood'])->name('food.register');
Route::get('/add-food-form', [FoodController::class, 'addFoodForm']);
Route::get('/add-menu', [MenuController::class, 'index']);
Route::get('/add-menu-form', [FoodController::class, 'addMenuFormIndex']);
Route::post('/add-menu-form', [MenuController::class, 'registerNewMenu'])->name('menu.register');
Route::get('/add-menu/{menuID}', [MenuController::class, 'viewMenuFood']);

// Order - operation side
Route::get('/op-orders', [OrderController::class, 'index']);
Route::post('/op-orders/{orderID}', [OrderController::class, 'viewOrder'])->name('op.order-view');

// Order - client side
Route::get('/customer-orders', [OrderListingController::class, 'index']);

// Purchase & Payment
Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('showPaymentPage');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');

// Business analytics
Route::get('/analytics', [AnalyticsController::class, 'index']);

// Display menu
Route::get('/food-menu', 'FoodMenuController@index')->name('food-menu');
