<canvas id="revenueChart" width="400" height="200"></canvas>

<script>
    var revenueData = <?php echo json_encode($revenueData); ?>; // Convert PHP data to JavaScript
    var ctx = document.getElementById('revenueChart').getContext('2d');

    var chart = new Chart(ctx, 
    {
        type: 'bar', // Change the chart type as needed
        data: 
        {
            labels: revenueData.labels,
            datasets: [
                {
                    label: 'Revenue',
                    data: revenueData.values,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize the chart colors
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
        },
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

<div>
    <h2>Revenue Data Table</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Revenue</th>
                <th>Expenses</th>
            </tr>
        </thead>
        <tbody>
            @foreach($revenueData as $entry)
                <tr>
                    <td>{{ $entry['date'] }}</td>
                    <td>{{ $entry['revenue'] }}</td>
                    <td>{{ $entry['expenses'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>