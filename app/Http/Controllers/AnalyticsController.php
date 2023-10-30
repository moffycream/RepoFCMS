<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\UserAccounts;
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
        $menus = Menu::all();
        $accounts = UserAccounts::all();

        // Calculate the total order amount
        $totalOrderAmount = $this->calculateTotalOrderAmount($menus, $orders);

        // Prepare data for a bar chart
        $chartData = $this->prepareChartData($orders, $menus);

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
        $totalRevenue = $orders->sum('total');

        return $totalRevenue;
    }

    private function calculateTotalOrderAmount($menuItem, $orders)
    {
        $totalRevenue = $orders->sum('total');
        // Calculate the total order amount
        return $totalRevenue;
    }

    private function prepareChartData($orders, $menu)
    {
        $chartData = 
        [
            'labels' => [],
            'data' => [],
        ];

        foreach ($menu as $menu) 
        {
            $chartData['labels'][] = $menu->name; // Assuming the menu item has a 'name' attribute
            $chartData['data'][] = $this->getTotalOrderAmountForMenuItem($menu, $orders);
        }

        return $chartData;
    }

    private function getTotalOrderAmountForMenuItem($menuItem, $orders)
    {
        // Calculate the total order amount for a specific menu item
        return $orders->where('menu_name', $menuItem->name)->sum('total');
    }
}
