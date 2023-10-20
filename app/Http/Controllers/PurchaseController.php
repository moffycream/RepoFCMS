<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\UserAccountController;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Notification;
use App\Models\UserAccounts;

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
            return view('purchase', compact('orders'), ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
        
    }

    public function ProcessPurchase(Request $request){

        if (session()->has('username')) {
            $userID = UserAccounts::where('username', session('username'))->first()->userID;
            if ($userID != null)
            {
                 //  New order instance
                $order = new Order();
                $order->userID = $userID;
                $order->order_notes = $request->input('purchase_orderNotes');
                $order->name = $request->input('purchase_realname');
                $order->address = $request->input('purchase_address');
                $order->contact = $request->input('purchase_contact');
                $order->dates = $request->input('purchase_dates');
                $order->status = 'pending'; // Manually set thestatus to "pending"
                $order->total = '10'; // Manually set the status to"pending"
                $order->menu_name = 'menu 1'; // Manually set thestatus to "pending"
                $totalPrice = 100; // Replace with your actual calculation.
                $order->save();
            }
        }

        return view('payment', ['totalPrice' => $totalPrice]);

    }
}
