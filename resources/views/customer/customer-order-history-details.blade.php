@extends('layouts.app')
@section('title', 'Orders-History-Details')
@section('content')

<h1 class="title">Order History Details</h1>
<div class="container-customer-view-order">
    <h1>Order #{{$selectedOrder->orderID}}</h1>
    <a href="{{url('customer-order-history')}}" title="close"><i class="fas fa-times"></i></a>
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
                <p>Order total price <span>RM{{$selectedOrder->total}}</span></p>
            </div>
        </div>
        <div class="col-customer-view-order">
            <div class="row-details">
                <div class="col-row-details">
                    <div>
                        <p class="customer-title">Customer Name</p>
                        <p class="customer-bold-info">{{$selectedOrder->name}}</p>
                    </div>
                    <div>
                        <p class="customer-title">Contact</p>
                        <p class="customer-contact"><i class="fas fa-phone-alt"></i>{{$selectedOrder->contact}}</p>
                    </div>
                    <div>
                        <p class="customer-title">Delivery method</p>
                        <p class="customer-order-info"><span><i class="fas fa-truck"></i>{{$selectedOrder->delivery}}</span></p>
                    </div>
                </div>
                <div class="col-row-details">
                    <div>
                        <p class="customer-title">Address</p>
                        <p class="customer-order-info"><i class="fas fa-map-marker-alt"></i>{{$selectedOrder->address}}</p>
                    </div>
                    <div>
                        <p class="customer-title">Order Notes</p>
                        <p class="customer-order-info"><i class="fas fa-sticky-note"></i>{{$selectedOrder->order_notes}}</span></p>
                    </div>
                </div>
                <div class="col-row-details">
                    <div>
                        <p class="customer-title">Order Data And Time</p>
                        <p class="customer-order-info"><span><i class="fas fa-clock"></i>{{$selectedOrder->getformattedDateTime()}}</span></p>
                    </div>
                    <div>
                        <p class="customer-title">Order Completed at</p>
                        <p class="customer-order-info"><span><i class="fas fa-check-square"></i>{{$selectedOrder->getFormattedDateTimeComplete()}}</span></p>
                    </div>
                </div>
            </div>
            <br>
            <div class="row-details">
                <div class="col-row-details">
                    <div>
                        <p class="customer-title">Transaction ID</p>
                        <p class="customer-bold-info">#{{$paymentInfo->transactionID}}</p>
                    </div>
                    <div>
                        <p class="customer-title">Payment Method</p>
                        <p class="customer-order-info"><i class="fas fa-money-check-alt"></i>{{$paymentInfo->payment_method}}</p>
                    </div>

                </div>
            </div>
            <div class="row-status">
                <p class="customer-title">Order Status</p>
                <p class="customer-status"><span class="status-{{ preg_replace('/[^a-zA-Z0-9]/', '',strtolower($selectedOrder->status))}}">{{$selectedOrder->status}}</span></p>
            </div>
            </table>
            <div class="row-actions">
                <form method="post" action="{{ route('order-again', ['orderID' => $selectedOrder->orderID]) }}">
                    @csrf
                    <button type="submit" class="customer-container-reorder-button">Order Again</button>
                </form>
            </div>

        </div>
    </div>
    @endsection