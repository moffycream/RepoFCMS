<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('menus')->get();
        return view('operation/op-orders', ['orders' => $orders]);
    }
}