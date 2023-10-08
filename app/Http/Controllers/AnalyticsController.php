<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Retrieve and process your business data here
        $profitData = 100; // Logic to calculate profit data
        $revenueData = 100; // Logic to calculate revenue data

        // Retrieve all orders
        $orders = \App\Models\Order::all();

        // Calculate the total order amount
        $totalOrderAmount = $orders->sum('order_amount');

        // Prepare data for a bar chart (example)
        $chartData = 
        [
            'labels' => $orders->pluck('customer_name'),
            'data' => $orders->pluck('order_amount'),
        ];

        // return view('analytics.index', compact('orders', 'totalOrderAmount', 'chartData'));
    }
}