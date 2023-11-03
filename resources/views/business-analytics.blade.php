@extends('layouts.admin')
@section('title', 'Business Analytics')
@section('content')

<div class="businessAnalytics-title">
    <h1>Business Analytics</h1>
</div>

<div class="businessAnalytics-main-content">

<div class="businessAnalytics-information-boxes">
    <div class="businessAnalytics-info-box">
        <h2>Purchase Frequency</h2>
        <p>Average purchase frequency in days: <strong>{{ $purchaseFrequency }} days</strong></p>
    </div>

    <div class="businessAnalytics-info-box">
        <h2>Sales Comparison</h2>
        <p>Sales in current month: <strong>{{ $currentMonthSales }}</strong></p>
        <p>Sales in the last month: <strong>{{ $lastMonthSales }}</strong></p>
        <p>Sales increase: <strong>{{ $salesIncrease }}%</strong></p>
    </div>

    <div class="businessAnalytics-info-box">
        <h2>Available Products</h2>
        <p>Total available products: <strong>{{ $availableProducts }}</strong></p>
    </div>

    <div class="businessAnalytics-info-box">
        <h2></h2>
        <p></p>
    </div>
</div>

<div class="businessAnalytics-data-table">
    <h2>Revenue Data Table</h2>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User ID</th>
                <th>Order Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalAmount = 0; // Initialize a variable to store the total amount
            @endphp

            @foreach ($orders as $UserAccounts)
                <tr>
                    <td>{{ $UserAccounts->orderID }}</td>
                    <td>{{ $UserAccounts->userID }}</td>
                    <td>RM {{ $UserAccounts->total }}</td>
                </tr>

                @php
                    $totalAmount += $UserAccounts->total; // Add the order total to the total amount
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">Total:</th>
                <td>RM {{ number_format($totalAmount, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>

<div class="businessAnalytics-total-revenue">
    <h1>Total Revenue: </h1>
</div>

<div class="businessAnalytics-chart-container">
    <canvas id="revenueChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('revenueChart').getContext('2d');

    // Chart data from the server
    var chartData = 
    {
        labels: <?php echo json_encode($chartData['labels']); ?>,
        datasets: 
        [
            {
                label: 'Revenue',
                data: <?php echo json_encode($chartData['data']); ?>, 
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the chart colors
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    };

    console.log(chartData);

    var chart = new Chart(ctx, 
    {
        type: 'bar',
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
    <h1>Total Order Amount: RM {{ $totalOrderAmount }}</h1>
</div>

<div class="businessAnalytics-monthly-sales">
    <h1>Monthly Sales vs. Orders</h1>
</div>

<div class="businessAnalytics-chart-container">
    <canvas id="monthlyChart" width="400" height="200"></canvas>
</div>

<script>
    // Get the data from the PHP variable
    var data = @json($monthlyData);

    var ctx = document.getElementById('monthlyChart').getContext('2d');

    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    // Create the chart
    var monthlyData = new Chart(ctx, 
    {
        type: 'bar',
        data: 
        {
            labels: months, 
            datasets: 
            [
                {
                    label: 'Sales',
                    data: mapData(data.sales, data.labels, months),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    yAxisID: 'sales-axis', // Assign the left y-axis to the "Sales" dataset
                },
                {
                    label: 'Orders',
                    data: mapData(data.orders, data.labels, months),
                    type: 'line', // Set the chart type for this dataset to 'line'
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    yAxisID: 'orders-axis', // Assign the right y-axis to the "Orders" dataset
                }
            ]
        },
        options: 
        {
            scales: 
            {
                y: 
                [
                    {
                        id: 'sales-axis', // Assign an ID to the left y-axis
                        type: 'linear',
                        position: 'left',
                        ticks: 
                        {
                            beginAtZero: true
                        }
                    },
                    {
                        id: 'orders-axis', // Assign an ID to the right y-axis
                        type: 'linear',
                        position: 'right',
                        ticks: 
                        {
                            beginAtZero: true
                        }
                    }
                ]
            }
        }
    });

    function mapData(data, originalLabels, months) 
    {
        var mappedData = new Array(months.length).fill(0);
        originalLabels.forEach(function(label, index) 
        {
            var monthIndex = months.indexOf(label);
            if (monthIndex !== -1) 
            {
                mappedData[monthIndex] = data[index];
            }
        });
        return mappedData;
    }
</script>
</div>
@endsection
