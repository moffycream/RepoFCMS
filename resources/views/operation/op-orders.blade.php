@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<div class="container-op-orders">
    <div class="panel">
        <div class="row-op-orders">
            <h1>Orders</h1>
        </div>
        <table class="row-op-orders">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Time</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @forelse($orders as $order)
            <tr>
                <td>{{$order->orderID}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->getformattedDate()}}</td>
                <td>{{$order->getformattedTime()}}</td>
                <td>RM {{$order->getTotalPrice()}}</td>
                <td ><span class="status-{{ preg_replace('/[^a-zA-Z0-9]/', '',strtolower($order->status))}}">{{$order->status}}</span></td>
                <td>
                    <a href="{{route('op.view-order', $order->orderID)}}">View</a>
                </td>
            </tr>
            @empty
            <tr class="empty">
                <td colspan="7">No orders right now</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>
@endsection