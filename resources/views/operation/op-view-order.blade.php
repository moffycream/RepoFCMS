@extends('layouts.app')
@section('title', 'View Order')
@section('content')
<div class="container-op-view-order">
    <h1>Order #{{$selectedOrder->orderID}}</h1>
    <a href="{{url('op-orders')}}" title="close"><i class="fas fa-times"></i></a>
    <div class="panel">
        <div class="col-op-view-order">
            <div class="row-item">
                <h2>{{$selectedOrder->menus->count()}} Items</h2>
                @foreach($selectedOrder->menus as $menu)
                <details>
                    <summary>
                        <span>{{$menu->name}}</span>
                        <span>RM{{$menu->totalPrice}}</span>
                    </summary>
                    <table>
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
            <div class="row-add-on">
                <p>Add-ons: {{$selectedOrder->order_notes}}</p>
            </div>
            <div class="row-total-price">
                <p>Order total <span>RM{{$selectedOrder->getTotalPrice()}}</span></p>
            </div>
        </div>
        <div class="col-op-view-order">
            <div class="row-details">
                <div class="col-row-details">
                    <p>Name: {{$selectedOrder->name}}</p>
                    <p>Address: {{$selectedOrder->address}}</p>
                </div>
                <div class="col-row-details">
                    <p>Contact: {{$selectedOrder->contact}}</p>
                    <p>Status: {{$selectedOrder->status}}</p>
                </div>
            </div>
            <div class="row-actions">
                @if($selectedOrder->status == 'preparing')
                <a href="{{route('op.complete-order', $selectedOrder->orderID)}}">Ready for pickup</a>
                @else
                <a href="{{route('op.accept-order', $selectedOrder->orderID)}}">Accept</a>
                @endif
                <a class="cancel" href="{{route('op.reject-order', $selectedOrder->orderID)}}" title="cancel order"><i class="fas fa-trash"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection

{{--
    <h1>Order #{{$selectedOrder->orderID}}</h1>
--}}