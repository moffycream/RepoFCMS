<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;

// validations
class PurchaseController extends Controller
{

    public function index()
    {
        $orders = Order::all(); // Retrieve all orders from the database
        return view('purchase', compact('orders'));
    }
}
