<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderListingController extends Controller
{
    public function index()
    {
        $order_list = Order::all();
        return view('customer-orders', ['orders' => $order_list]);
    }

    public function viewOrderDetails($orderID)
    {
        $selectedOrder = Order::find($orderID);
    
        return view('customer-orders-listings', ['selectedOrder' => $selectedOrder]);
    }

    public function cancelOrder($orderID)
    {
        // Retrieve the order by ID
        $order = Order::find($orderID);
        $order->delete();
        $order_list = Order::all();
        return view('customer-orders', ['orders' => $order_list]);
    }
}
