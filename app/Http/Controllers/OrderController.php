<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // add this

class OrderController extends Controller
{
    public function createNewOrder()
    {
        $order = new Order();
        $order->client_id = 1;
        $order->total_amount = 100.00;
        $order->save();
        // Return a JSON response to indicate success
        return response()->json(['message' => 'Order created successfully'], 201);
    }
}