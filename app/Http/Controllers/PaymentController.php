<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserAccountController;

// validations
class PaymentController extends Controller
{
    // used for verification
    protected $userAccountController;
    public function index(UserAccountController $userAccountController)
    {
        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('payment');
        } else {
            return view('login.access-denied');
        }
    }

    public function showPaymentPage(UserAccountController $userAccountController)
    {
        $totalPrice = DB::table('orders')->sum('total');
        $orders = DB::table('orders')->get();

        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('payment', compact('totalPrice', 'orders'));
        } else {
            return view('login.access-denied');
        }
    }
}
