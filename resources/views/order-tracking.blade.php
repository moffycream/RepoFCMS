@extends('layouts.app')
@section('title', 'Order Tracking')
@section('content')

<div class="order-tracking-container">

    <h1>Order Tracking</h1>

    <section id="order-tracking-order-status">
        <h2>Order Status</h2>
        <p>Current status: </p>
    </section>

    <div class="order-tracking-details">
        <section id="order-tracking-order-details">
            <h2>Order Details</h2>
            <ul>
                <li>Order ID: </li>
                <li>Product: </li>
                <li>Quantity: </li>
                <li>Total Amount: </li>
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