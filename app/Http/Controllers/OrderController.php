<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('operation.op-orders', ['orders'=>$orders]);
    }

    public function viewOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        return view('operation.op-view-order', ['orders'=>$orders], ['selectedOrder'=>$selectedOrder]);
    }

    public function acceptOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "preparing";
        return view('operation.op-view-order', ['orders'=>$orders], ['selectedOrder'=>$selectedOrder]);
    }

    public function rejectOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "rejected";
        return view('operation.op-view-order', ['orders'=>$orders], ['selectedOrder'=>$selectedOrder]);
    }

    public function cancelOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::all()->find($orderID);
        $selectedOrder->delete();
        return redirect('/op-orders');
    }
}