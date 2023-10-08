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
                <th>Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Add On</th>
            </tr>
        </thead>
        <tbody>
            @if($selectedOrder)
                <tr>
                    <td>{{ $selectedOrder->orderID }}</td>
                    <td>{{ $selectedOrder->getformattedDateTime() }}</td>
                    <td>{{ $selectedOrder->status }}</td>
                    <td>RM{{ $selectedOrder->total }}</td>
                    <td>{{ $selectedOrder->name }}</td>
                    <td>{{ $selectedOrder->address }}</td>
                    <td>{{ $selectedOrder->contact }}</td>
                    <td>RM{{ $selectedOrder->order_notes }}</td>
                </tr>
            @else
                <tr>
                    <td colspan="5">No order details found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
