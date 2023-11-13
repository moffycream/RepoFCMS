@extends('layouts.app')
@section('title', 'Purchase')
@section('content')

<div class="container-purchase-page">
    <h1>Purchase Page</h1>

    <form id="PurchaseForm" method="post" action="{{ route('process.purchase') }}">
        @csrf
        <table id="display_purchase_item_table">
            <thead>
                <tr>
                    <th>Menu ID</th>
                    <th>Menu Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    @php
                    $overallTotalPrice = 0; // Initialize order total price with 0
                    @endphp


                    @foreach ($cart as $item)

                    @php
                    $itemTotalPrice = $item['quantity'] * $item['price']; // Calculate total price per item
                    $overallTotalPrice += $itemTotalPrice; // Add item total to overall total

                    @endphp

                <tr>
                    <td>{{ $item['menu']->menuID }}</td>
                    <td>{{ $item['menu']->name }}</td>
                    {{-- Hidden input field to store the value of the menu name --}}
                    <input type="hidden" name="menu_names[]" value="{{ $item['menu']->name }}">
                    <input type="hidden" name="menu_ids[]" value="{{ $item['menu']->menuID }}">
                    <td>{{ $item['quantity'] }}</td>
                    <input type="hidden" name=menu_quantities[] value="{{ $item['quantity'] }}">
                    <td>RM {{ $itemTotalPrice }}</td>
                </tr>
                @endforeach

                @php
                // Store cart data and overall total price in the session
                session(['overallTotalPrice' => $overallTotalPrice]);
                @endphp

                </tr>
            </tbody>

            <tr>
                <td>
                    Order Total Price
                </td>

                <td></td>
                <td></td>

                <td>
                    <strong>RM {{ $overallTotalPrice }}</strong>
                    {{-- Hidden input field to store the value of the overallTotalPrice --}}
                    <input id="purchase_overall_total_price" type="hidden" name="overallTotalPrice" value="{{ $overallTotalPrice }}">
                    <div id="purchase_overallTotalPrice_error" class="purchase_error"></div>
                </td>
            <tr>    
        </table>

        <table id="purchase_form_table">

            <tr>
                <td>
                    <label for="purchase_realname:">Name: </label>
                </td>

                <td>
                    <input type="text" id="purchase_realname" name="purchase_realname" placeholder="Name" required>
                    <div id="purchase_realname_error" class="purchase_error"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="address:">Address: </label>
                </td>

                <td>
                    <input type="text" id="purchase_address" name="purchase_address" placeholder="Address" required>
                    <div id="purchase_address_error" class="purchase_error"></div>

                </td>
            </tr>

            <tr>
                <td>
                    <label for="contact:">Contact: </label>
                </td>

                <td>
                    <input type="text" id="purchase_contact" name="purchase_contact" placeholder="Contact" required>
                    <div id="purchase_contact_error" class="purchase_error"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="deliveryMethod:">Delivery Method: </label>
                </td>

                <td>
                    <select id="purchase_deliveryMethod" name="purchase_deliveryMethod">
                        <option value="none" disabled selected>Delivery method</option>
                        <option value="Delivery">Delivery</option>
                        <option value="Self Pick Up">Self Pick Up</option>
                    </select> 
                    <div id="purchase_deliveryMethod_error" class="purchase_error"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="purchase_orderNotes:">Message: </label>
                </td>

                <td>
                    <textarea id="purchase_orderNotes" name="purchase_orderNotes" placeholder="Message: (e.g. Cleaning crew, special request )" rows="4" cols="50"></textarea>
                    <div id="purchase_orderNotes_error" class="purchase_error"></div>
                </td>
            </tr>

            <td><button type="submit">Next</button></td>
        </table>
    </form>

</div>

@endsection