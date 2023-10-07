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

    // public function viewOrder($orderID)
    // {

    //     return view('')
    // }
}