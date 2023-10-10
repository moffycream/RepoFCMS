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
                <td>{{$order->status}}</td>
                <td>
                    <form method="post" action="{{route('op.view-order', $order->orderID)}}">
                        @csrf
                        <button type="submit">View</button>
                    </form>
                </td>
            </tr>
            @empty
            @endforelse
        </table>
    </div>
</div>
@endsection