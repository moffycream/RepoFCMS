<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\UserAccounts;
use App\Http\Controllers\AdminController;

class AnalyticsController extends Controller
{
    // used for verification
    protected $adminController;
    protected $date;
    public function index(AdminController $adminController)
    {
        // Retrieve and process your business data here
        $profitData = $this->calculateProfit(); // Logic to calculate profit data
        $revenueData = $this->calculateRevenue(); // Logic to calculate revenue data

        // Retrieve all orders
        $orders = Order::all();
        $sortedOrders = Order::orderBy('date')->get();
        $menus = Menu::all();
        $accounts = UserAccounts::all();

        // Calculate the total order amount
        $totalOrderAmount = $this->calculateTotalOrderAmount($menus, $orders);

        // Prepare data for the first graph
        $chartData = $this->prepareChartData($orders, $menus);

        // New method to prepare data for the date-sorted line chart
        $dateChartData = $this->prepareDateChartData($orders);

        // Call the showBusinessAnalytics method to get the monthly data
        $monthlyData = $this->showBusinessAnalytics($orders);

        // Checks whether is admin session or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) 
        {
            return view('business-analytics', compact('orders', 'totalOrderAmount', 'chartData', 'dateChartData', 'profitData', 'revenueData', 'monthlyData'));

        } 
        else 
        {
            return view('login.access-denied');
        }
    }

    private function calculateProfit()
    {
        $totalRevenue = $this->calculateRevenue();
        $profit = $totalRevenue - 3000;

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
            $chartData['labels'][] = $menu->name; 
            $chartData['data'][] = $this->getTotalOrderAmountForMenuItem($menu, $orders);
        }

        return $chartData;
    }

    private function prepareDateChartData($orders)
    {
        $dateChartData = 
        [
            'labels' => [],
            'data' => [],
        ];

        // Retrieve orders sorted by date
        $sortedOrders = Order::orderBy('date')->get();

        foreach ($sortedOrders as $orders) 
        {
            // Use Carbon to format the date for display on the chart
            $formattedDate = Carbon::parse($orders->date)->toDateString();
            $dateChartData['labels'][] = $formattedDate;
            $dateChartData['data'][] = $orders->total; 
        }

        return $dateChartData;
    }

    private function getTotalOrderAmountForMenuItem($menuItem, $orders)
    {
        // Calculate the total order amount for a specific menu item
        return $orders->where('menu_name', $menuItem->name)->sum('total');
    }

    private function showBusinessAnalytics($orders)
    {
        $monthlyData = 
        [
            'labels' => [],
            'sales' => [],
            'orders' => [],
        ];

        $monthlySales = [];
        $monthlyOrderCounts = [];

        foreach ($orders as $order) 
        {
            $date = $order->date;
            $month = date('F', strtotime($date));

            if (!isset($monthlySales[$month])) 
            {
                $monthlySales[$month] = $order->total;
                $monthlyOrderCounts[$month] = 1;
            } 
            else 
            {
                $monthlySales[$month] += $order->total;
                $monthlyOrderCounts[$month]++;
            }
        }

        $monthlyData['labels'] = array_keys($monthlySales);
        $monthlyData['sales'] = array_values($monthlySales);
        $monthlyData['orders'] = array_values($monthlyOrderCounts);

        return $monthlyData;
    }
}
