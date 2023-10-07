@extends('layouts.app')
@section('title', 'Orders')
@section('content')

<div class="container-op-orders">
    <div class="row">
        <h1>Order List</h1>
    </div>
    <div class="row">
        @forelse($orders as $order)
        <div class="row-order-item">

            <h2>Order #{{$order->orderID}}</h2>
            <p>{{$order->getformattedDateTime()}}</p>
            <h3>Associated Menus:</h3>
            <ul>
                @foreach($order->menus as $menu)
                <li>{{$menu->name}}</li>
                @endforeach
            </ul>

        </div>
        @empty
        @endforelse
    </div>
</div>



@endsection