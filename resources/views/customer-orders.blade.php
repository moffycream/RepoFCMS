<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include ('include/head')

@include ('include/header')

<article>
    <h1 class="title">Customer Order Listing</h1>
    <table class="custom-table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date And Time</th>
            <th>Status</th>
            <th>Total Amount</th>
            <th>Menu Name</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->orderID }}</td>
            <td>{{ $order->getformattedDateTime() }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->menu_name }}</td>
            <td>{{ $order->order_notes }}</td>
            <td>
    <a href="{{ route('viewOrder', ['orderID' => $order->orderID]) }}" class="view-details-button">View Details</a>
</td>

        </tr>
        @endforeach
    </tbody>
</table>


    </article>
@include ('include/footer')
</html>

<!-- Credit https://www.nicepng.com/downpng/u2y3a9e6t4o0a9w7_profile-picture-default-png/*/  -->