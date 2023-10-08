@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<h1 class="title">Customer Order Listing</h1>
    <div class="customer-container-order-listing"> 
        <table class="customer-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date And Time</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Menu Name</th>
                    <th>Notes</th>
                    <th>Actions</th>
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
                        <a href="{{ route('op.order-view', ['orderID' => $order->orderID]) }}" class="view-details-button">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
