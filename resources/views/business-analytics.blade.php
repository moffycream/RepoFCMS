@extends('layouts.admin')
@section('title', 'Business Analytics')
@section('content')


<div class="page-content-container">
    <div class="businessAnalytics-title">
        <h1 class="title">Business Analytics</h1>
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
            <p>Sales : <strong>{{ $salesIncrease }}%</strong></p>
        </div>

        <div class="businessAnalytics-info-box">
            <h2>Orders Comparison</h2>
            <p>Order in current month: <strong>{{ $currentMonthOrders }}</strong></p>
            <p>Orders in the last month: <strong>{{ $lastMonthOrders }}</strong></p>
            <p>Orders : <strong>{{ $orderIncrease }}%</strong></p>
        </div>

        <div class="businessAnalytics-info-box">
            <h2>Available Products</h2>
            <p>Total available products: <strong>{{ $availableProducts }}</strong></p>
        </div>
    </div>

    <div class="businessAnalytics-data-table">
        <h2>Revenue Data Table</h2>
        <div class="businessAnalytics-backgroun-color">
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
</div>

<div class="businessAnalytics-total-revenue">
    <h1>Total Revenue: </h1>
</div>

<div class="businessAnalytics-background-color">
    <div class="businessAnalytics-chart-container">
        <canvas id="revenueChart" width="400" height="200"></canvas>
    </div>
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
                backgroundColor: 'rgba(75, 192, 192, 0.2)', 
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

<!-- Display Monthly Sales vs. Orders -->
<div class="businessAnalytics-monthly-sales">
    <h1>Monthly Sales vs. Orders</h1>
</div>

<div class="businessAnalytics-background-color">
    <!-- Create a container for the chart and control elements -->
    <div class="businessAnalytics-chart-container" style="position: relative;">
        <!-- Chart canvas -->
        <canvas id="monthlyChart" width="400" height="200"></canvas>

        <!-- Sorting button in the top right corner -->
        <button id="sortButton" disabled style="position: absolute; top: 10px; right: 10px;">Sort Ascending</button>

        <!-- Dropdown for data selection in the top right corner -->
        <select id="dataSelector" style="position: absolute; top: 10px; right: 113px;">
            <option value="both">Both Sales and Orders</option>
            <option value="sales">Sales</option>
            <option value="orders">Orders</option>
        </select>
    </div>
</div>

<script>
    var data = @json($monthlyData);
    var originalData = JSON.parse(JSON.stringify(data));
    var ctx = document.getElementById('monthlyChart').getContext('2d');
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    var chartData = 
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
                yAxisID: 'sales-axis',
                hidden: false // Initially show sales
            },
            {
                label: 'Orders',
                data: mapData(data.orders, data.labels, months),
                type: 'line',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                yAxisID: 'orders-axis',
                hidden: false // Initially show orders
            }
        ]
    };

    var monthlyData = new Chart(ctx, 
    {
        type: 'bar',
        data: chartData,
        options: 
        {
            scales: 
            {
                y: 
                [
                    {
                        id: 'sales-axis',
                        type: 'linear',
                        position: 'left',
                        ticks: 
                        {
                            beginAtZero: true
                        }
                    },
                    {
                        id: 'orders-axis',
                        type: 'linear',
                        position: 'right',
                        ticks: {
                            beginAtZero: true
                        }
                    }
                ]
            }
        }
    });

    // Toggle the visibility of datasets
    function toggleDatasetVisibility(chart, datasetIndex) 
    {
        chart.getDatasetMeta(datasetIndex).hidden = !chart.getDatasetMeta(datasetIndex).hidden;
        chart.update();
        // Enable the sort button when a single data type is selected
        document.getElementById('sortButton').disabled = document.getElementById('dataSelector').value === 'both';
    }

    // Data selector dropdown
    document.getElementById('dataSelector').addEventListener('change', function () 
    {
        var selectedValue = this.value;
        if (selectedValue === 'both') 
        {
            data = JSON.parse(JSON.stringify(originalData)); // Restore the original data

            chartData.labels = months;
            chartData.datasets[0].data = mapData(data.sales, data.labels, months);
            chartData.datasets[1].data = mapData(data.orders, data.labels, months);

            chartData.datasets[0].hidden = false;
            chartData.datasets[1].hidden = false;
        } 
        else if (selectedValue === 'sales') 
        {
            chartData.datasets[0].hidden = false;
            chartData.datasets[1].hidden = true;
        } 
        else if (selectedValue === 'orders') 
        {
            chartData.datasets[0].hidden = true;
            chartData.datasets[1].hidden = false;
        }
        monthlyData.update();
        // Enable or disable the sort button based on the selected data type
        document.getElementById('sortButton').disabled = selectedValue === 'both';
    });


    // Sort button
    var ascending = true; // Initially sort in ascending order

    function updateSortButtonText() 
    {
        const sortButton = document.getElementById('sortButton');
        sortButton.textContent = ascending ? 'Sort Ascending' : 'Sort Descending';
    }

    updateSortButtonText();

    document.getElementById('sortButton').addEventListener('click', function () 
    {
        ascending = !ascending; // Toggle between ascending and descending
        updateSortButtonText(); // Update the button text

        // Sort the data and labels
        var sortedDataAndLabels = sortDataAndLabels(chartData.datasets[0].data, chartData.datasets[1].data, chartData.labels, ascending);

        // Update the x-axis labels
        monthlyData.data.labels = sortedDataAndLabels.labels;

        // Update the data for both Sales and Orders
        chartData.datasets[0].data = sortedDataAndLabels.data1;
        chartData.datasets[1].data = sortedDataAndLabels.data2;

        monthlyData.update();
    });

    // Function to sort data and labels
    function sortDataAndLabels(data1, data2, labels, ascending) 
    {
        var combinedData = labels.map(function (label, index) 
        {
            return {
                label: label,
                data1: data1[index],
                data2: data2[index],
            };
        });

        // Sort combinedData based on data1 (Sales) or data2 (Orders)
        combinedData.sort(function (a, b) 
        {
            if (ascending) 
            {
                return a.data1 - b.data1; // Sort by Sales in ascending order
            } 
            else 
            {
                return b.data1 - a.data1; // Sort by Sales in descending order
            }
        });

        // Update data1, data2, and labels based on the sorted combinedData
        data1 = combinedData.map(function (item) 
        {
            return item.data1;
        });
        data2 = combinedData.map(function (item) 
        {
            return item.data2;
        });
        labels = combinedData.map(function (item) 
        {
            return item.label;
        });

        return {
            data1: data1,
            data2: data2,
            labels: labels,
        };
    }

    // Sort data in ascending or descending order
    function sortData(data, ascending) 
    {
        var sortedData = data.slice();

        sortedData.sort(function (a, b) 
        {
            if (ascending) 
            {
                return a - b;
            } else 
            {
                return b - a;
            }
        });

        return sortedData;
    }


    // Map data to months
    function mapData(data, originalLabels, months) 
    {
        var mappedData = new Array(months.length).fill(0);
        originalLabels.forEach(function (label, index) 
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
@endsection
