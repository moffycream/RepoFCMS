<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserAccountController;
use App\Models\Notification;

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
            return view('payment', ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function showPaymentPage()
    {
        // Retrieve the user's cart from the session
        $cart = session('cart', []);

        // Check if $cart is null and initialize it as an empty array
        if ($cart === null) {
            $cart = [];
        }

        // Retrieve notifications (if needed)
        $notifications = Notification::all();

        // Pass both the cart and notifications to the payment page
        return view('payment', ['cart' => $cart, 'notifications' => $notifications]);

    }

    public function store(Request $request){
        return redirect()->route('food-menu')->with('success', 'Payment successful');
    }

    public function success()
    {
        return view('payment-success');
    }
}
