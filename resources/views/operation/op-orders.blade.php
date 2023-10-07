@extends('layouts.app')
@section('title', 'Orders')
@section('content')

<div class="container-op-orders">
    <div class="container">
        <div class="row">
            <h1>Order List</h1>
        </div>
        <div class="row-order-item">
            @foreach($orders as $order)
            <form method="post" action="{{route('viewOrder', $order->orderID)}}">
                {{ csrf_field() }}
                <button type="submit">
                    <p>Order #{{$order->orderID}}</p>
                    <p>{{$order->getformattedDateTime()}}</p>
                </button>
            </form>
            @endforeach
        </div>
    </div>
    <div class="container">
        @if(isset($selectedOrder))
        <h3>Menus:</h3>
        <ul>
            @foreach($selectedOrder->menus as $menu)
            <li>{{$menu->name}}</li>
            @endforeach
        </ul>
        @endif
    </div>
</div>


@endsection