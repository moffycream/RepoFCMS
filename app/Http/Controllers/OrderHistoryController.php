<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\UserAccounts;
use Illuminate\Http\Request;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Log;


class OrderHistoryController extends Controller
{
    protected $userAccountController;
    public function index()
    {
        $userAccountController = app(UserAccountController::class);
        $order_list = Order::all();

        $userAccount = UserAccounts::where('username', session('username'))->first();
        if ($userAccount) {
            $userID = $userAccount->userID;
        } else {
            $userID = null;
        }

        $order_list = [];
        if ($userID != null) {
            $order_list = Order::where('userID', $userID)->get();
        }

        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer.customer-order-history', ['orders' => $order_list]);
        } else {
            return view('login.access-denied');
        }
    }

    public function viewOrderHistoryDetails($orderID)
    {
        $userAccountController = app(UserAccountController::class);
        $selectedOrder = Order::find($orderID);

        if ($selectedOrder) {
            // Load payment information associated with the selected order
            $paymentInfo = $selectedOrder->payment;

            if ($userAccountController->verifyCustomer()) {
                // Debug statement to check if paymentInfo exists
                if ($paymentInfo) {
                    // Payment information exists, you can add debug statements or log it
                    // Example: Log paymentInfo to Laravel log
                    Log::info('Payment Information: ' . json_encode($paymentInfo));
                } else {
                    // Payment information doesn't exist
                    Log::info('No payment information found for Order #' . $selectedOrder->orderID);
                }

                return view('customer.customer-order-history-details', [
                    'selectedOrder' => $selectedOrder,
                    'paymentInfo' => $paymentInfo,
                ]);
            } else {
                return view('login.access-denied');
            }
        }
    }

    public function deleteOrderHistory($orderID)
    {
        // Find the order by order ID
        $order = Order::find($orderID);
        if ($order) {
            // Delete the order
            $order->delete();
            return redirect()->route('customer-order-history', ['orderID' => $orderID])->with('success', 'Order deleted successfully');
        }
    }

}
