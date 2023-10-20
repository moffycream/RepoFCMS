@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<h1 class="title">Order Details</h1>
<div class="customer-container">
    <table class="customer-container-table ">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date And Time</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Name</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Order Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($selectedOrder)
            <tr>
                <td>{{ $selectedOrder->orderID }}</td>
                <td>{{ $selectedOrder->getformattedDateTime() }}</td>
                <td>{{ $selectedOrder->status }}</td>
                <td>RM{{ $selectedOrder->total }}</td>
                <td>{{ $selectedOrder->name }}</td>
                <td>{{ $selectedOrder->address }}</td>
                <td>{{ $selectedOrder->contact }}</td>
                <td>{{ $selectedOrder->order_notes }}</td>
                <td>
                    <form method="post" action="{{ route('customer-cancel-order', ['orderID' => $selectedOrder->orderID]) }}">
                        @csrf
                        <!-- the data status is to store the status of the order then used in js validation-->
                        <!--the ? is used to detect the status is cancel or preparing, if yes then it will called customer container disabled button class, else it will call the customer container cancel button class-->
                        <button type="submit" data-status="{{ $selectedOrder->status }}" 
                        class="customer-container-cancel-button {{ $selectedOrder->status === 'preparing' 
                            || $selectedOrder->status === 'Order Cancelled. The refund will be done within 5-7 working days.' ? 'customer-container-disabled-button' : '' }}">Cancel Order</button>
                    </form>
                </td>
            </tr>
            @foreach($selectedOrder->menus as $menu)
            <tr>
                <td colspan="9">
                    <div class="customer-container-food-menu-container">
                        <p>Food Menu Name: {{ $menu->name }}</p>
                        <div class="customer-container-food-menu-container-food-items">
                            @foreach($menu->foods as $food)
                            <p>Food: {{ $food->name }}</p>
                                @endforeach
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="9">No order details found</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection