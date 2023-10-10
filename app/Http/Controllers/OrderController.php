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
        
        // checks whether it is operation team or is admin, if either one access is allow
        if ($this->adminController->verifyOperationTeam() || $this->adminController->verifyAdmin()) {
            return view('operation.op-orders', ['orders' => $orders]);
        } else {
            return view('login.access-denied');
        }
    }

    public function viewOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        return view('operation.op-orders', ['orders' => $orders], ['selectedOrder' => $selectedOrder]);
    }

    public function cancelOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::all()->find($orderID);
        $selectedOrder->delete();
        return redirect('/op-orders');
    }
}
