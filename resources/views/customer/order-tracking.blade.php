@extends('layouts.app')
@section('title', 'Order Tracking')
@section('content')

<div class="order-tracking-container">

    <h1>Order Tracking</h1>

    <section id="order-tracking-order-status">
        <h2>Order Status</h2>
    </section>

    <div class="order-tracking-details">
        <section id="order-tracking-order-details">
            <h2>Order Details</h2>
            <ul>
                <li>Order ID: {{$selectedOrder->orderID}}</li>
                <li>Menu Name: {{$selectedOrder->menu_name}}</li>
                <li>Address: {{$selectedOrder->address}}</li>
                <li>Contact: {{$selectedOrder->contact}}</li>
                <li>Status Update Time: {{$selectedOrder->status_update_time}}</li>
                <li>Status: {{$selectedOrder->status}}</li>
                <li>Delivery Method: {{$selectedOrder->delivery}}</li>
            </ul>
        </section>

        <section id="order-tracking-payment-details">
            <h2>Payment Details</h2>
            <ul>
                <li>Transaction ID: {{$selectedOrder->payment->transactionID}}</li>
                <li>Payment Time: {{$selectedOrder->payment->dateOfPayment}}</li>
                <li>Payment Method: {{$selectedOrder->payment->payment_method}}</li>
                <li>Total Paid: {{$selectedOrder->payment->total_price}}</li>
            </ul>
        </section>
        
        <section id="order-tracking-company-details">
            <h2>Company Details</h2>
            <ul>
                <li>Company Name: <strong>Food Edge</strong></li>
                <li>Phone Number: <strong>012-3456789</strong></li>
                <li>Working Hours: <strong>Monday to Friday (9:00 AM - 5:00 PM)</strong></li>
            </ul>
        </section>
    </div>
</div>
@endsection