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
                    <div>
                        <p class="customer-title">Customer</p>
                        <p class="customer-name">{{$selectedOrder->name}}</p>

                    </div>
                    <div>
                        <p class="customer-title">Contact</p>
                        <p class="customer-contact"><i class="fas fa-phone-alt"></i>{{$selectedOrder->contact}}</p>
                    </div>
                </div>
                <div>
                    <p class="customer-title">Address</p>
                    <p class="customer-address"><i class="fas fa-map-marker-alt"></i>{{$selectedOrder->address}}</p>
                </div>
                <div>
                    <p class="customer-title">Delivery method</p>
                    <p class="customer-delivery"><span><i class="fas fa-truck"></i>{{$selectedOrder->delivery}}</span></p>
                </div>
            </div>


            <div class="row-status">
                 @php
                    if($selectedOrder->status == "Order Cancelled. The refund will be done within 5-7 working days.") {
                        $selectedOrder->status = "Cancelled";
                    }
                @endphp
                <p class="customer-title">Order Status</p>
                <p class="customer-status"><span class="status-{{ preg_replace('/[^a-zA-Z0-9]/', '',strtolower($selectedOrder->status))}}">{{$selectedOrder->status}}</span></p>
            </div>
            <div class="row-actions">
                @if($selectedOrder->status == 'Preparing')
                <a href="{{route('op.ready-for-pickup-order', $selectedOrder->orderID)}}">Ready for pickup</a>
                @elseif($selectedOrder->status == 'Ready for pickup')
                <a href="{{route('op.complete-order', $selectedOrder->orderID)}}">Complete</a>
                @else
                <a href="{{route('op.accept-order', $selectedOrder->orderID)}}">Accept</a>
                @endif
                <a class="cancel" href="{{route('op.cancel-order', $selectedOrder->orderID)}}" title="cancel order"><i class="fas fa-trash"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection

{{--
    <h1>Order #{{$selectedOrder->orderID}}</h1>
--}}