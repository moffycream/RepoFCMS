@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<h1 class="title">Order Listing</h1>
<div class="container-customer">
    <table class="container-customer-table">
        <thead>
            <tr>
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
                @if($order->status != "Completed")
                <td>{{ $order->getformattedDateTime()}}</td>
                @php
                $classStatus="";
                if($order->status == "Order Cancelled. The refund will be done within 5-7 working days.")
                {
                    $classStatus = "cancelled";
                }
                elseif ($order->status=="Pending")
                {
                    $classStatus="pending";
                }

                elseif($order->status=="Preparing")
                {
                    $classStatus = "preparing";
                }
                else if($order->status=="Ready for pickup")
                {
                    $classStatus = "readyforpickup";
                }
                else if($order->status=="Delivery on the way")
                {
                    $classStatus = "deliveryontheway";
                }
                else if($order->status=="Ready for pickup")
                {
                    $classStatus = "readyforpickup";
                }
                @endphp
                <td><span class="status-{{ preg_replace('/[^a-zA-Z0-9]/', '',strtolower($classStatus))}}">{{$order->status}}</span></td>
                <td>RM{{ $order->total }}</td>
                <td>{{$order->delivery}}</td>
                <td>
                    <form method="post" action="{{ route('customer-orders-listings', ['orderID' => $order->orderID]) }}" class="view-details-button">
                        @csrf
                        <button type="submit">View</button>
                    </form>
                </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="5">No orders right! Go grab your first order</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection