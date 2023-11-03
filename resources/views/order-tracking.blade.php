@extends('layouts.app')
@section('title', 'Order Tracking')
@section('content')

<div class="order-tracking-container">

    <h1>Order Tracking</h1>

    <section id="order-tracking-order-status">
        <h2>Order Status</h2>
        <p>Current status: </p>
    </section>
    
    <section id="order-tracking-order-details">
        <h2>Order Details</h2>
        <ul>
            <li>Order ID: </li>
            <li>Product: </li>
            <li>Quantity: </li>
            <li>Total Amount: </li>
            <!-- Add more order details as needed -->
        </ul>
    </section>
    
    <section id="order-tracking-company-details">
        <h2>Company Details</h2>
        <p>Company Name: </p>
        <p>Phone Number: </p>
        <p>Working Hours: Monday to Friday (9:00 AM - 5:00 PM)</p>
    </section>
</div>
@endsection