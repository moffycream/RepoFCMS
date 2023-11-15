@extends('layouts.app')
@section('title', 'Orders-Listings')
@section('content')

<h1 class="title">Order Details</h1>
<div class="container-customer-view-order">
    <h1>Order #{{$selectedOrder->orderID}}</h1>
    <a href="{{url('customer-orders')}}" title="close"><i class="fas fa-times"></i></a>
    <div class="panel">
        <div class="col-customer-view-order">
            <div class="row-element">
                <h2>Food Menu Ordered: {{$selectedOrder->menus->count()}}</h2>
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
            <div class="row-total-price">
                <p>Order total price <span>RM{{$selectedOrder->getTotalPrice()}}</span></p>
            </div>
        </div>
        <div class="col-customer-view-order">
            <div class="row-details">
                <div class="col-row-details">
                    <div>
                        <p class="customer-title">Customer</p>
                        <p class="customer-bold-info">{{$selectedOrder->name}}</p>
                    </div>
                    <div>
                        <p class="customer-title">Contact</p>
                        <p class="customer-contact"><i class="fas fa-phone-alt"></i>{{$selectedOrder->contact}}</p>
                    </div>
                </div>
                <div>
                    <p class="customer-title">Address</p>
                    <p class="customer-order-info"><i class="fas fa-map-marker-alt"></i>{{$selectedOrder->address}}</p>
                </div>

                <div>
                    <p class="customer-title">Order Notes</p>
                    <p class="customer-order-info"><i class="fas fa-sticky-note"></i>{{$selectedOrder->order_notes}}</span></p>
                </div>
                <div>

                    <p class="customer-title">Order Data And Time</p>
                    <p class="customer-order-info"><span><i class="fas fa-clock"></i>{{$selectedOrder->getformattedDateTime()}}</span></p>
                </div>
                <div>
                    <p class="customer-title">Delivery method</p>
                    <p class="customer-order-info"><span><i class="fas fa-truck"></i>{{$selectedOrder->delivery}}</span></p>
                </div>

            </div>

            <div>
                <form action="{{ route('order-tracking', ['orderID' => $selectedOrder->orderID]) }}" method="get">
                    <button type="submit" id='customer-container-track-button' class="button">Track Order</button>
                </form>
            </div>

            <div class="row-status">
                @php
                $classStatus="";
                if($selectedOrder->status == "Order Cancelled. The refund will be done within 5-7 working days.")
                {
                $classStatus ="cancelled";
                $selectedOrder->status = "Order Cancelled. The refund will be done within 5-7 working days.";
                }
                elseif ($selectedOrder->status=="Pending")
                {
                $classStatus="pending";
                }

                elseif($selectedOrder->status=="Preparing")
                {
                $classStatus ="preparing";
                }
                else if($selectedOrder->status=="Delivery on the way")
                {
                $classStatus = "deliveryontheway";
                }
                else if($$selectedOrder->status=="Ready for pickup")
                {
                $classStatus = "readyforpickup";
                }
                @endphp
                <p class="customer-title">Order Status</p>
                <p class="customer-status"><div class="status-{{ preg_replace('/[^a-zA-Z0-9]/', '',strtolower($classStatus))}}">{{$selectedOrder->status}}</div></p>
            </div>
            <div class="row-actions">

            </div>

            <div class="row-actions">
                @if(($selectedOrder->status === 'Ready for pick up')||($selectedOrder->status=== 'Delivery on the way'))
                <form method="post" action="{{ route('customer-complete-order', ['orderID' => $selectedOrder->orderID]) }}">
                    @csrf
                    <button type="submit" class="customer-container-complete-button">Complete the order</button>
                </form>
                @else
                <form method="post" action="{{ route('customer-cancel-order', ['orderID' => $selectedOrder->orderID]) }}">
                    @csrf
                    <!-- the data status is to store the status of the order then used in js validation-->
                    <!--the ? is used to detect the status is cancel or preparing, if yes then it will called customer container disabled button class, else it will call the customer container cancel button class-->
                    <button type="submit" data-status="{{ $selectedOrder->status }}" class="customer-container-cancel-button {{ $selectedOrder->status === 'Preparing' 
                                || $selectedOrder->status === 'Order Cancelled. The refund will be done within 5-7 working days.'? 'customer-container-disabled-button' : '' }}">Cancel Order</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection