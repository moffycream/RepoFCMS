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
}
