@extends('layouts.admin')
@section('title', 'Business Analytics')
@section('content')

<div class="businessAnalytics-chart-container">
    <canvas id="revenueChart" width="400" height="200"></canvas>
</div>

<div class="businessAnalytics-chart-container">
    <canvas id="dateChart" width="400" height="200"></canvas>
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
            @foreach ($orders as $UserAccounts)
                <tr>
                    <td>{{ $UserAccounts->orderID }}</td>
                    <td>{{ $UserAccounts->userID }}</td>
                    <td>RM {{ $UserAccounts->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
