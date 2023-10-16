@extends('layouts.app')
@section('title', 'Home')
@section('content')

<div class="businessAnalytics-chart-container">
    <canvas id="revenueChart" width="400" height="200"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');

    // Function to generate random data
    function generateRandomData(count) 
    {
        var data = [];
        for (var i = 0; i < count; i++) 
        {
            data.push(Math.floor(Math.random() * 1000)); // Change the range and logic as needed
        }
        return data;
    }

    var chartData = 
    {
        labels: <?php echo json_encode($chartData['labels']); ?>,
        datasets: 
        [
            {
                label: 'Revenue',
                data: generateRandomData(<?php echo count($chartData['labels']); ?>), // Generate random data
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the chart colors
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    };

    var chart = new Chart(ctx, 
    {
        type: 'bar', // Change the chart type as needed
        data: chartData,
        options: 
        {
            scales: 
            {
                y: 
                {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<div class="businessAnalytics-total-order-amount">
    <h1>Total Order Amount: ${{ $totalOrderAmount }}</h1>
</div>

<div class="businessAnalytics-data-table">
    <h2>Revenue Data Table</h2>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Order Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->order_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="businessAnalytics-data-table">
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->order_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
