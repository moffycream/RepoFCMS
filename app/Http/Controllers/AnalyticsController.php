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

    protected $orders;
    protected $date;
    public function index(AdminController $adminController)
    {
        // Retrieve all orders
        $orders = Order::all();
        $sortedOrders = Order::orderBy('date')->get();
        $menus = Menu::all();
        $accounts = UserAccounts::all();

        $this->orders = Order::all();

        // Calculate the total order amount
        $totalOrderAmount = $this->calculateTotalOrderAmount($menus, $orders);

        // Prepare data for the first graph
        $chartData = $this->prepareChartData($orders, $menus);

        // Call the showBusinessAnalytics method to get the monthly data
        $monthlyData = $this->showBusinessAnalytics($orders);

        $purchaseFrequency = $this->calculatePurchaseFrequency($orders);
        $currentMonthSales = $this->calculateCurrentMonthSales($orders);
        $lastMonthSales = $this->calculateLastMonthSales($orders);
        $salesIncrease = $this->calculateSalesIncrease($currentMonthSales, $lastMonthSales);
        $availableProducts = $this->calculateAvailableProducts($menus);

        // Checks whether is admin session or not
        $this->adminController = $adminController;

        if ($this->adminController->verifyAdmin()) 
        {
            return view('business-analytics', compact(
                'orders',
                'totalOrderAmount',
                'chartData',
                'monthlyData',
                'purchaseFrequency',
                'currentMonthSales',
                'lastMonthSales',
                'salesIncrease',
                'availableProducts'
            ));
        } 
        else 
        {
            return view('login.access-denied');
        }
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

    private function getTotalOrderAmountForMenuItem($menuItem, $orders)
    {
        // Calculate the total order amount for a specific menu item
        return $orders->where('menu_name', $menuItem->name)->sum('total');
    }

    private function showBusinessAnalytics($orders)
    {
        $monthlyData = 
        [
            'labels' => ['January', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
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

    private function calculatePurchaseFrequency($orders)
    {
        $orderDates = $orders->pluck('date');
        $dateDifferences = [];

        for ($i = 0; $i < count($orderDates) - 1; $i++) 
        {
            $date1 = Carbon::parse($orderDates[$i]);
            $date2 = Carbon::parse($orderDates[$i + 1]);
            $dateDifferences[] = $date2->diffInDays($date1);
        }

        if (count($dateDifferences) === 0) 
        {
            return 0;
        }

        $averageFrequency = array_sum($dateDifferences) / count($dateDifferences);

        return round($averageFrequency, 2);
    }

    private function calculateCurrentMonthSales($orders)
    {
        $currentMonth = Carbon::now()->month;
        
        $currentMonthSales = 0;

        foreach ($orders as $order) {
            $orderDate = Carbon::parse($order->date);
            if ($orderDate->month == $currentMonth) {
                $currentMonthSales += $order->total;
            }
        }

        return $currentMonthSales;
    }

    private function calculateLastMonthSales($orders)
    {
        $lastMonth = Carbon::now()->subMonth()->month;

        $lastMonthSales = $orders->filter(function ($order) use ($lastMonth) {
            $orderDate = Carbon::parse($order->date);
            return $orderDate->month === $lastMonth;
        })->sum('total');

        return $lastMonthSales;
    }

    private function calculateSalesIncrease($currentMonthSales, $lastMonthSales)
    {
        if ($lastMonthSales === 0) {
            return 0; 
        }

        $increase = (($currentMonthSales - $lastMonthSales) / $lastMonthSales) * 100;

        return round($increase, 2);
    }

    private function calculateAvailableProducts($menus)
    {
        $availableProducts = $menus->where('status', 'available')->count();

        return $availableProducts;
    }
}
