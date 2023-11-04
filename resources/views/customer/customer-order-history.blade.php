@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<h1 class="title">Order History</h1>
<div class="container-customer">
    <table class="container-customer-table">
        <thead>
            <tr>
                <th>OrderID</th>
                <th>Order Date And Time</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Delivery Method</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                @if($order->status == "Completed")
                <td>{{ $order->orderID }}</td>
                <td>{{ $order->getformattedDateTime()}}</td>
                <td><span class="status-{{ preg_replace('/[^a-zA-Z0-9]/', '',strtolower($order->status))}}">{{$order->status}}</span></td>
                <td>RM{{ $order->total }}</td>
                <td>{{$order->delivery}}</td>
                <td>
                    <form method="post" action="{{ route('customer-order-history-details', ['orderID' => $order->orderID]) }}" class="view-details-button">
                        @csrf
                        <button type="submit">View</button>
                    </form>
                    <form method="post" action="{{ route('customer-delete-order-history', ['orderID' => $order->orderID]) }}" class="view-details-button">
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="7">No order history</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
