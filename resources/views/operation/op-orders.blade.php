@extends('layouts.app')
@section('title', 'Orders')
@section('content')

<div class="container-op-orders">
    <div class="container-op-orders-col-1">
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
    <div class="container-op-orders-col-2">
        @if(isset($selectedOrder))
        <h2>Order Info</h2>
        <table>
            @foreach($selectedOrder->menus as $menu)
            <tr>
                <td>{{$menu->name}}</td>
            </tr>
                @foreach($menu->foods as $food)
                    <tr>
                        <td>food: {{$food->name}}</td>
                    </tr>
                @endforeach
            @endforeach
        </table>
        <h2>Add-Ons</h2>
        @endif
    </div>
</div>


@endsection