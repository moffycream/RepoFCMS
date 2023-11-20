@extends('layouts.app')
@section('title', 'Order Tracking')
@section('content')

<div class="order-tracking-container">

    <h1>Order Tracking</h1>

    <div class="order-tracking-details">
        <!-- Display Order Details -->
        <section id="order-tracking-order-details">
            <h2>Order Details</h2>
            <table>
                <tr>
                    <td>Order ID: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->orderID}}</span></td>
                </tr>

                <tr>
                    <td>Menu Name: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->menu_name}}</span></td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->address}}</span></td>
                </tr>

                <tr>
                    <td>Contact: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->contact}}</span></td>
                </tr>

                <tr>
                    <td>Status Update Time: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->status_update_time}}</span></td>
                </tr>

                <tr>
                    <td>Status: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->status}}</span></td>
                </tr>

                <tr>
                    <td>Delivery Method: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->delivery}}</span></td>
                </tr>
                

            </table>
        </section>

        <!-- Display Payment Details -->
        <section id="order-tracking-payment-details">
            <h2>Payment Details</h2>
            <table>
                <tr>
                    <td>Transaction ID: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->payment->transactionID}}</span></td>
                </tr>

                <tr>
                    <td>Payment Time: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->payment->dateOfPayment}}</span></td>
                </tr>

                <tr>
                    <td>Payment Method: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->payment->payment_method}}</span></td>
                </tr>

                <tr>
                    <td>Total Paid: </td>
                    <td><span id='order-tracking-data-span'>{{$selectedOrder->payment->total_price}}</span></td>
                </tr>
            </table>
        </section>
        
        <!-- Display Company Details -->
        <section id="order-tracking-company-details">
            <h2>Company Details</h2>
            <table>
                <tr>
                    <td>Company Name: </td>
                    <td><span id='order-tracking-data-span'>Food Edge</span></td>
                </tr>

                <tr>
                    <td>Phone Number: </td>
                    <td><span id='order-tracking-data-span'>012-3456789</span></td>
                </tr>

                <tr>
                    <td>Working Hours: </td>
                    <td><span id='order-tracking-data-span'>Monday to Friday <br> (9:00 AM - 5:00 PM)</span></td>
                </tr>
            </table>
        </section>
    </div>
</div>
@endsection