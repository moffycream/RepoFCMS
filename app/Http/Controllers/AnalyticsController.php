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

        if ($this->adminController->verifyAdmin()) 
        {
            return view('business-analytics', compact('orders', 'totalOrderAmount', 'chartData', 'profitData', 'revenueData'));
        } 
        else 
        {
            return view('login.access-denied');
        }
    }

    private function calculateProfit()
    {
        $totalRevenue = $this->calculateRevenue();
        $profit = $totalRevenue - 100;

        return $profit;
    }

    private function calculateRevenue()
    {
        $orders = Order::all();
        $totalRevenue = $orders->sum('order_amount');

        return $totalRevenue;
    }

    private function calculateTotalOrderAmount()
    {
        $totalRevenue = 1000;
        // Calculate the total order amount
        return $totalRevenue;
    }

    private function prepareChartData($orders)
    {
        // You can change this logic to generate random data as needed
        $randomLabels = ['Menu 1', 'Menu 2', 'Menu 3', 'Menu 4', 'Menu 5'];
        $randomData = [];
        
        foreach ($randomLabels as $label) {
            $randomData[] = rand(100, 1000); // Generate random data values (adjust the range as needed)
        }

        $chartData = [
            'labels' => $randomLabels,
            'data' => $randomData,
        ];

        return $chartData;
    }

}
