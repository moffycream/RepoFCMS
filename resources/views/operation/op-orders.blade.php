@extends('layouts.app')
@section('title', 'Orders')
@section('content')

<p class="dummy-op-orders"></p>
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
<p class="dummy-op-orders"></p>
@endsection

{{-- <div class="container-op-orders">
    <div class="container">
        <h1>Order List</h1>
        @foreach($orders as $order)
        <div class="row-order-item">
            <form method="post" action="{{route('op.order-view', $order->orderID)}}">
{{ csrf_field() }}
<button type="submit">
    <div class="row">
        <p>Order #{{$order->orderID}}</p>
        <p>{{$order->getformattedDateTime()}}</p>
    </div>
    <p class="col">RM{{$order->getTotalPrice()}}</p>
</button>
</form>
</div>
@endforeach
</div>
<div class="container">
    @if(isset($selectedOrder))
    <h2>Order Details</h2>
    <div class="row-details">
        <p>Name: {{$selectedOrder->name}}</p>
        <p>Contact: {{$selectedOrder->contact}}</p>
        <p>Address: {{$selectedOrder->address}}</p>
        <p>Status: {{$selectedOrder->status}}</p>
    </div>
    
    <div class="row-addon">
        <h3>Add-Ons</h3>
        <p>{{$selectedOrder->order_notes}}</p>
    </div>
    <div class="row-price">
        <p>Total Price: RM{{$selectedOrder->getTotalPrice()}}</p>
    </div>
    <div class="row-action">
        <a href="{{route('op.order-cancel', $selectedOrder->orderID)}}">Cancel Order</a>
        <a>Accept Order</a>
    </div>
    @endif
</div>
</div> --}}