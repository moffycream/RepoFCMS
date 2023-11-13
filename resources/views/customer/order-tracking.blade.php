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
                <li>Order ID: <span id="order-id"></span></li>
                <li>Menu Name: <span id="menu-name"></span></li>
                <li>Address: <span id="delivery-address"></span></li>
                <li>Contact: <span id="contact-number"></span></li>
                <li>Status Update Time: <span id="order-status-update-time"></span></li>
                <li>Status: <span id="order-status"></span></li>
                <li>Delivery Method: <span id="delivery-method"></span></li>
            </ul>
        </section>

        <section id="order-tracking-payment-details">
            <h2>Payment Details</h2>
            <ul>
                <li>Payment Time: <span id="payment-time"></span></li>
                <li>Payment Method: <span id="payment-method"></span></li>
                <li>Total Paid: <span id="total-paid"></span></li>
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