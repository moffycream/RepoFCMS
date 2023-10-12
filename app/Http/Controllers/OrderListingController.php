<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\UserAccountController;
use App\Models\Notification;

class OrderListingController extends Controller
{
    // used for verification
    protected $userAccountController;
    public function index(UserAccountController $userAccountController)
    {
        $order_list = Order::all();

        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer.customer-orders', ['orders' => $order_list], ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function viewOrderDetails($orderID, UserAccountController $userAccountController)
    {
        $selectedOrder = Order::find($orderID);

        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer.customer-orders-listings', ['selectedOrder' => $selectedOrder], ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function cancelOrder($orderID)
    {
        $order = Order::find($orderID);
        $selectedOrder = $order;
        $selectedOrder->status = 'Order Cancelled. The refund will be done within 5-7 working days.';
        $selectedOrder->save();
        return redirect('/customer-orders')->with(['orders' => $order]);
    }
}
