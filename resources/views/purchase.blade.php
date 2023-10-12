@extends('layouts.app')
@section('title', 'Purchase')
@section('content')

<div class="container-purchase-page">
    <h1>Purchase Page</h1>
    <!-- <table>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Status</th>
            <th>Total</th>
            <th>Menu Name</th>
            <th>Order Notes</th>
            <th>Name</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>
    
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->orderID }}</td>
                <td>{{ $order->userID }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->menu_name }}</td>
                <td>{{ $order->order_notes }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->contact }}</td>
            </tr>
        @endforeach
    </table> -->

    <form id="PurchaseForm" method="post" action="">
        @csrf
        <table border = 1>
            <tr>
                <td>
                    <label for="orderNotes:">Order Notes: </label>   
                </td>

                <td>
                    <input type="text" id="orderNotes" name="orderNotes" placeholder="Order Notes" required>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="realname:">Name: </label>   
                </td>

                <td>
                    <input type="text" id="realname" name="realname" placeholder="Name" required>
                </td>
            </tr>

            <tr>
            <td>
                    <label for="address:">Address: </label>   
                </td>

                <td>
                    <input type="text" id="address" name="address" placeholder="Address" required>
                </td>
            </tr>

            <tr>
            <td>
                    <label for="contact:">Contact: </label>   
                </td>

                <td>
                    <input type="text" id="contact" name="contact" placeholder="Contact" required>
                </td>
            </tr>

            <tr>
            <td>
                    <label for="dates:">Dates: </label>   
                </td>

                <td>
                    <input type="date" id="dates" name="dates" placeholder="Dates" required>
                </td>
            </tr>

            <tr>
                <td><button type="submit">Next</button></td>
            </tr>
        </table> 
    </form>

</div>

@endsection