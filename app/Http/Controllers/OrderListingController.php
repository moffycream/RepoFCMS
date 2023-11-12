<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserAccounts;
use Illuminate\Http\Request;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\NotificationController;

class OrderListingController extends Controller
{
    // used for verification
    protected $userAccountController;
    public function index()
    {
        $userAccountController = app(UserAccountController::class);
        $order_list = Order::all();

        $userAccount = UserAccounts::where('username', session('username'))->first();
        if ($userAccount)
        {
            $userID = $userAccount->userID;
        }
        else
        {
            $userID = null;
        }
        
        $order_list = [];
        if ($userID != null)
        {
            $order_list = Order::where('userID', $userID)->get();
        }

        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer.customer-orders', ['orders' => $order_list]);
        } else {
            return view('login.access-denied');
        }
    }

    public function viewOrderDetails($orderID)
    {
        $userAccountController = app(UserAccountController::class);
        $selectedOrder = Order::find($orderID);
        if ($userAccountController->verifyCustomer()) {
            return view('customer.customer-orders-listings', ['selectedOrder' => $selectedOrder]);
        } else {
            return view('login.access-denied');
        }
    }

    public function trackOrder($orderID){
        $userAccountController = app(UserAccountController::class);
        $selectedOrder = Order::find($orderID);

        if ($userAccountController->verifyCustomer()) {
            return view('customer.order-tracking', ['selectedOrder' => $selectedOrder]);
        } else {
            return view('login.access-denied');
        }
    }

    public function cancelOrder($orderID)
    {
        $notificationController = app(NotificationController::class);
        $notificationController->notifyOperationTeam('Order ' . $orderID . ' has been cancelled.');
        $order = Order::find($orderID);
        $selectedOrder = $order;
        $selectedOrder->status = 'Order Cancelled. The refund will be done within 5-7 working days.';
        $selectedOrder->save();
        return redirect('/customer-orders')->with(['orders' => $order]);
    }

    public function completeOrder($orderID)
    {
        $notificationController = app(NotificationController::class);
        $notificationController->notifyOperationTeam('Order ' . $orderID . ' has been completed.');
        $order = Order::find($orderID);
        $selectedOrder = $order;
        $selectedOrder->status = 'Completed';
        $selectedOrder->save();
        $selectedOrder->updated_at = now();
        return redirect('/customer-orders')->with(['orders' => $order]);
    }
}
