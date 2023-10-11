<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\AdminController;

class OrderController extends Controller
{
    // used for verification
    protected $adminController;

    public function index(AdminController $adminController)
    {
        $orders = Order::all();

        // Checks whether is valid login or not
        $this->adminController = $adminController;
        
        return view('operation.op-orders', ['orders' => $orders]);
        // checks whether it is operation team or is admin, if either one access is allow
        // if ($this->adminController->verifyOperationTeam() || $this->adminController->verifyAdmin()) {
        // } else {
        //     return view('login.access-denied');
        // }
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
        $selectedOrder->save();
        return view('operation.op-view-order', ['orders'=>$orders], ['selectedOrder'=>$selectedOrder]);
    }

    public function completeOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "completed";
        $selectedOrder->save();
        return redirect('/op-orders')->with(['orders'=>$orders]);
    }

    public function rejectOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "rejected";
        $selectedOrder->save();
        return redirect('/op-orders')->with(['orders'=>$orders]);
    }

    public function cancelOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::all()->find($orderID);
        $selectedOrder->delete();
        return redirect('/op-orders');
    }
}
