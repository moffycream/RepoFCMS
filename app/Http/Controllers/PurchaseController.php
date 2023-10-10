<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\UserAccountController;
use App\Models\Payment;
use App\Models\Order;

// validations
class PurchaseController extends Controller
{
    protected $userAccountController;

    public function index(UserAccountController $userAccountController)
    {
        $orders = Order::all(); // Retrieve all orders from the database

        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('purchase', compact('orders'));
        } else {
            return view('login.access-denied');
        }
        
    }
}
