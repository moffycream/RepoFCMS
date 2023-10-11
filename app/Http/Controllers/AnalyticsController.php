<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Controllers\AdminController;

class AnalyticsController extends Controller
{
    // used for verification
    protected $adminController;
    public function index(AdminController $adminController)
    {
        // Retrieve and process your business data here
        $profitData = $this->calculateProfit(); // Logic to calculate profit data
        $revenueData = $this->calculateRevenue(); // Logic to calculate revenue data

        // Retrieve all orders
        $orders = Order::all();

        // Calculate the total order amount
        $totalOrderAmount = $this->calculateTotalOrderAmount($orders);

        // Prepare data for a bar chart
        $chartData = $this->prepareChartData($orders);

        // Checks whether is admin session or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) {
            return view('business-analytics', compact('orders', 'totalOrderAmount', 'chartData', 'profitData', 'revenueData'));
        } else {
            return view('login.access-denied');
        }
    }

    private function calculateProfit()
    {
        return 100; //replace with your actual calculation
    }

    private function calculateRevenue()
    {
        return 100; // Example value, replace with your actual calculation
    }

    private function calculateTotalOrderAmount($orders)
    {
        // Calculate the total order amount
        return $orders->sum('order_amount');
    }

    private function prepareChartData($orders)
    {
        // Prepare data for a bar chart
        $chartData =
            [
                'labels' => $orders->pluck('customer_name'),
                'data' => $orders->pluck('order_amount'),
            ];

        return $chartData;
    }
}
