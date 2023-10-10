@extends('layouts.app')
@section('title', 'View Order')
@section('content')
<div class="container-op-view-order">
    <h1>Order #{{$selectedOrder->orderID}}</h1>
    <div class="panel">
        <div class="col-op-view-order">
            <div class="row-item">
                <h2>{{$selectedOrder->menus->count()}} Items</h2>
                @foreach($selectedOrder->menus as $menu)
                <details>
                    <summary>
                        <span>{{$menu->name}}</span>
                        <span>RM {{$menu->totalPrice}}</span>
                    </summary>
                    <table>
                        @foreach($menu->foods as $food)
                        <tr>
                            <td class="container-food-image"><img src="{{asset($food->imagePath)}}" alt="{{$food->name}}"></td>
                            <td>{{$food->name}}</td>
                            <td>RM {{$food->price}}</td>
                        </tr>
                        @endforeach
                    </table>
                </details>
                @endforeach
            </div>
            <div class="row-add-on">
                <p>Add-ons: {{$selectedOrder->order_notes}}</p>
            </div>
        </div>
        <div class="col-op-view-order">
            <div class="row-details">
                <p>Name: {{$selectedOrder->name}}</p>
                <p>Contact: {{$selectedOrder->contact}}</p>
                <p>Address: {{$selectedOrder->address}}</p>
                <p>Status: {{$selectedOrder->status}}</p>
            </div>
            <div class="row-actions">
                <a href="{{route('op.accept-order', $selectedOrder->orderID)}}">Accept</a>
                <a href="{{route('op.reject-order', $selectedOrder->orderID)}}">Reject</a>
            </div>
        </div>
    </div>
</div>

@endsection

{{--
    <h1>Order #{{$selectedOrder->orderID}}</h1>
--}}