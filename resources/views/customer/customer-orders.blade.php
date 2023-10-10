@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<h1 class="title">Customer Order Listing</h1>
<div class="customer-container"> 
    <table class="customer-container-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date And Time</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->orderID }}</td>
                <td>{{ $order->getformattedDateTime() }}</td>
                <td>{{ $order->status }}</td>
                <td>RM{{ $order->total }}</td>
                <td>
                    <form method="post" action="{{ route('customer-orders-listings', ['orderID' => $order->orderID]) }}" class="view-details-button">
                        @csrf
                        <button type="submit">View Details</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No orders</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
