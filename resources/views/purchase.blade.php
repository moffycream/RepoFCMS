@extends('layouts.app')
@section('title', 'Purchase')
@section('content')

<div class="container-purchase-page">
    <h1>Purchase Page</h1>

    <form id="PurchaseForm" method="post" action="{{ route('process.purchase') }}">
        @csrf
        <table id= "display_purchase_item_table">
            <tr>
                <th>Menu ID</th>
                <th>Menu Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>

            <tr>
                @foreach ($cart as $item)
                    
                    @php
                        $overallTotalPrice = 0; // Initialize overall total price
                        $itemTotalPrice = $item['quantity'] * $item['price']; // Calculate total price per item
                        $overallTotalPrice += $itemTotalPrice; // Add item total to overall total
                    @endphp

                <tr>
                    <td>{{ $item['menu']->menuID }}</td>
                    <td>{{ $item['menu']->name }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>$ {{ $itemTotalPrice }}</td>
                </tr>
                @endforeach
            </tr>
        </table>

        <table id="purchase_form_table">

            <tr>
                <td>
                    <label for="orderNotes:">Order Notes: </label>   
                </td>

                <td>
                    <input type="text" id="purchase_orderNotes" name="purchase_orderNotes" placeholder="Order Notes: (e.g. Cleaning crew, special request )" reqired>
                    
                </td>
            </tr>

            <tr>
                <td>
                    <label for="realname:">Name: </label>   
                </td>

                <td>
                    <input type="text" id="purchase_realname" name="purchase_realname" placeholder="Name" required>
                </td>
            </tr>

            <tr>
            <td>
                    <label for="address:">Address: </label>   
                </td>

                <td>
                    <input type="text" id="purchase_address" name="purchase_address" placeholder="Address" required>
                </td>
            </tr>

            <tr>
            <td>
                    <label for="contact:">Contact: </label>   
                </td>

                <td>
                    <input type="text" id="purchase_contact" name="purchase_contact" placeholder="Contact" required>
                </td>
            </tr>

            <tr>
            <td>
                    <label for="dates:">Dates: </label>   
                </td>

                <td>
                    <input type="date" id="purchase_dates" name="purchase_dates" placeholder="Dates" required>
                </td>
            </tr>

            <tr>
                <td><button type="submit">Next</button></td>
            </tr>
        </table> 
    </form>

</div>

@endsection