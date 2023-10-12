@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<h1 class="title">Customer Order Details</h1>
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
                <th>Add On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($selectedOrder)
                <tr>
                    <td>{{ $selectedOrder->orderID }}</td>
                    <td>{{ $selectedOrder->getformattedDate() }}</td>
                    <td>{{ $selectedOrder->status }}</td>
                    <td>RM{{ $selectedOrder->total }}</td>
                    <td>{{ $selectedOrder->name }}</td>
                    <td>{{ $selectedOrder->address }}</td>
                    <td>{{ $selectedOrder->contact }}</td>
                    <td>{{ $selectedOrder->order_notes }}</td>
                    <td>
                    
                    <form method="post" action="{{ route('cancel-order', ['orderID' => $selectedOrder->orderID]) }}">
                    @csrf
                    <button type="submit" onclick="return confirmCancel('{{ $selectedOrder->status }}')" class="customer-container-cancel-button">Cancel Order</button>
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
                                        <p>Food: {{ $food->name }}<p>
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
