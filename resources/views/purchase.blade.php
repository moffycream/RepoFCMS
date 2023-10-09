@extends('layouts.app')
@section('title', 'Purchase')
@section('content')

<div class="container-purchase-page">
    <h1>Purchase Page</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Status</th>
            <th>Total</th>
            <th>Menu Name</th>
            <th>Order Notes</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>
    
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->orderID }}</td>
                <td>{{ $order->userID }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->menu_name }}</td>
                <td>{{ $order->order_notes }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->contact }}</td>
            </tr>
        @endforeach
    </table>
</div>

@endsection