<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('operation/op-orders', ['orders'=>$orders]);
    }

    public function viewOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        return view('operation/op-orders', ['orders'=>$orders], ['selectedOrder'=>$selectedOrder]);
    }
}