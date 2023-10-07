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
        <div>
            <h2>Order Info</h2>
            <h3>Menu</h3>
            @foreach($selectedOrder->menus as $menu)
            <details>
                <summary>
                    <span>{{$menu->name}}</span>
                    <span>RM{{$menu->totalPrice}}</span>
                </summary>
                <table class="container-food-item">
                    @foreach($menu->foods as $food)
                    <tr>
                        <td class="container-food-image"><img src="{{asset($food->imagePath)}}" alt="{{$food->name}}"></td>
                        <td>{{$food->name}}</td>
                        <td>RM{{$food->price}}</td>
                    </tr>
                    @endforeach
                </table>
            </details>
            @endforeach
        </div>
        <div>
            <h3>Add-Ons</h3>
            <p>{{$selectedOrder->order_notes}}</p>
        </div>
        <div>
            <p>Total Price: RM{{$selectedOrder->getTotalPrice()}}</p>
        </div>
        @endif
    </div>
</div>


@endsection