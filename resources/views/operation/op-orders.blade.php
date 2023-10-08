@extends('layouts.app')
@section('title', 'Orders')
@section('content')

<div class="container-op-orders">
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
            <p>Name: </p>
            <p>Contact: </p>
            <p>Address: </p>
            <p>Status: </p>
        </div>
        <div class="row-menu">
            <h3>Menu</h3>
            @foreach($selectedOrder->menus as $menu)
            <details>
                <summary>
                    <span>{{$menu->name}}</span>
                    <span>RM{{$menu->totalPrice}}</span>
                </summary>
                <table class="food-item">
                    @foreach($menu->foods as $food)
                    <tr>
                        <td class="food-image"><img src="{{asset($food->imagePath)}}" alt="{{$food->name}}"></td>
                        <td>{{$food->name}}</td>
                        <td>RM{{$food->price}}</td>
                    </tr>
                    @endforeach
                </table>
            </details>
            @endforeach
        </div>
        <div class="row-addon">
            <h3>Add-Ons</h3>
            <p>{{$selectedOrder->order_notes}}</p>
        </div>
        <div class="row-price">
            <p>Total Price: RM{{$selectedOrder->getTotalPrice()}}</p>
        </div>
        <div class="row-action">
            <p><button>Cancel Order</button></p>
            <p><button>Accept Order</button></p>
        </div>
        @endif
    </div>
</div>
@endsection