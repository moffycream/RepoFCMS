<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MembershipController;
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
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ReviewController;


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

// Notification
Route::put('/mark-notification-as-read/{notificationID}', [NotificationController::class, 'markAsRead'])->name('mark-notification-as-read');

// Customer profile
Route::get('/customer-profile', [ProfileController::class, 'index'])->name('customer-profile');
Route::get('/customer-order-history', [OrderHistoryController::class, 'index'])->name('customer-order-history');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/customer-orders-listings/{orderID}', [OrderListingController::class, 'viewOrderDetails'])->name('customer-orders-listings');

Route::post('/customer-order-listings/{orderID}/complete', [OrderListingController::class, 'completeOrder'])->name('customer-complete-order');

Route::post('/customer-order-listings/{orderID}/cancel', [OrderListingController::class, 'cancelOrder'])->name('customer-cancel-order');

Route::post('/customer-order-history/{orderID}/delete', [OrderHistoryController::class, 'deleteOrderHistory'])->name('customer-delete-order-history');

Route::post('/profile}', [ProfileController::class, 'editProfile'])->name('profile.edit');


// Login and register
Route::get('/login', [UserAccountController::class, 'setDefaultAdmin']);
Route::get('/login', [UserAccountController::class, 'index']);
Route::post('/login', [LoginController::class, 'index'])->name('user.login');
Route::get('/two-factor-authentication',[MailController::class, 'index']);
Route::post('/two-factor-authentication', [LoginController::class, 'verify2FA'])->name('user.verify2FA');
Route::get('/logout', [LoginController::class, 'endSession']);
Route::get('/forgot-password', [LoginController::class, 'forgotPassword']);
Route::post('/forgot-password', [LoginController::class, 'resetPassword'])->name('user.resetpassword');
Route::get('/register', [UserAccountController::class, 'register']);
Route::post('/register', [UserAccountController::class, 'registerNewAccount'])->name('user.register');
Route::get('/register/register-success', [UserAccountController::class, 'registerSuccess']);

// Admin - dashboard
Route::get('/admin-dashboard', [AdminController::class, 'index']);
Route::get('/admin-register', [AdminController::class, 'adminRegister']);
Route::get('/admin-business-analytics', [AdminController::class, 'adminBusinessAnalytics']);
Route::post('/admin-register', [AdminController::class, 'adminRegisterNewAccount'])->name('admin.register');
Route::get('/admin-register-success', [AdminController::class, 'adminRegisterSuccess']);

// Menu - client side
Route::get('/menu', [MenuController::class, 'index']);

// Food - management side
Route::get('/add-food', [FoodController::class, 'index']);
Route::post('/add-food', [FoodController::class, 'registerNewFood'])->name('food.register');
Route::get('/add-food/{id}', [FoodController::class, 'deleteFood'])->name('food.delete');
Route::get('/add-food-form', [FoodController::class, 'addFoodForm']);

// Food - edit food
Route::put('/add-food', [FoodController::class, 'editFood'])->name('food.edit');

// Menu - management site
Route::get('/add-menu', [MenuController::class, 'index']);
Route::get('/add-menu-form', [FoodController::class, 'addMenuFormIndex']);
Route::post('/add-menu-form', [MenuController::class, 'registerNewMenu'])->name('menu.register');
Route::get('/add-menu/{menuID}', [MenuController::class, 'viewMenuFood']);

// Menu - edit menu
Route::put('/add-menu', [MenuController::class, 'editMenu'])->name('menu.edit');

// Inventory
Route::get('/inventory-management', [InventoryController::class, 'index']);
Route::put('/inventory-management', [InventoryController::class, 'registerNewInventory'])->name('inventory.register');
Route::post('/inventory-management', [InventoryController::class, 'editInventory'])->name('inventory.edit');
Route::get('/inventory-management/{id}', [InventoryController::class, 'deleteInventory'])->name('inventory.delete');



// Order - operation side
Route::get('/op-orders', [OrderController::class, 'index']);
Route::get('/op-view-order/{orderID}', [OrderController::class, 'viewOrder'])->name('op.view-order');
Route::get('/op-view-order/accept/{orderID}', [OrderController::class, 'acceptOrder'])->name('op.accept-order');
Route::get('/op-view-order/ready-for-pickup/{orderID}', [OrderController::class, 'readyForPickupOrder'])->name('op.ready-for-pickup-order');
Route::get('/op-view-order/complete/{orderID}', [OrderController::class, 'completeOrder'])->name('op.complete-order');
Route::get('/op-view-order/cancel/{orderID}', [OrderController::class, 'cancelOrder'])->name('op.cancel-order');

// Order - client side
Route::get('/customer-orders', [OrderListingController::class, 'index']);

// Payment
Route::get('/payment', [PaymentController::class, 'showPaymentPage'])->name('payment.show');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('processPayment');
Route::get('/payment-success', [PaymentController::class, 'success'])->name('payment-success');
Route::post('/store-payment', [PaymentController::class, 'store'])->name('store-payment');
Route::get('food-menu', [FoodMenuController::class, 'index'])->name('food-menu');


// Purchase
Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');   // when access /purchase, index method triggered
Route::post('/payment', [PurchaseController::class, 'ProcessPurchase'])->name('process.purchase');

// Business analytics
Route::get('/business-analytics', [AnalyticsController::class, 'index']);

// Display menu
Route::get('/display-food-menu', [FoodMenuController::class, 'index'])->name('menu.index');
Route::post('/add-to-cart', [FoodMenuController::class, 'addToCart'])->name('food-menu.addToCart');
Route::post('/checkout', [FoodMenuController::class, 'checkout'])->name('food-menu.checkout');
Route::get('/cart', [FoodMenuController::class, 'showCart'])->name('food-menu.cart');

// Feedback
Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'submitFeedback'])->name('user.feedback');
Route::get('/feedback-success', [FeedbackController::class, 'feedbackSuccess']);

// admin view feedback
Route::get('/admin-view-feedback', [FeedbackController::class, 'adminViewFeedback']);
Route::post('/admin-view-feedback', [FeedbackController::class, 'adminFilterFeedback'])->name('admin.filter.feedback');

// Membership Controller 
Route::get('/membership', [MembershipController::class, 'index']);

// Order tracking 
Route::get('/order-tracking', [OrderTrackingController::class, 'index']);

// Reviews
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::post('/reviews', [ReviewController::class, 'submitComment'])->name('review.submit.comment');
Route::get('/reviews/review-form', [ReviewController::class, 'reviewForm']);
Route::post('/review/review-form/submit', [ReviewController::class, 'submitReviewForm'])->name('review.submit');