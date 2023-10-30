@extends('layouts.app')
@section('title', 'Payment')
@section('content')

<div class="container-payment-page">

    <h1>Orders:</h1>

    <form id="PaymentForm" method="post" action="{{ route('store-payment') }}"><!-- name at route -->
        @csrf
        <table id="payment_form_table">

            {{--@if(count($cart) > 0)
                @foreach ($cart as $cartItem)
                    <div class="cartItem">
                        <h3>{{ $cartItem['menu']->name }}</h3>
                        <img src="{{ $cartItem['menu']->imagePath }}" alt="{{ $cartItem['menu']->name }}" width="200">
                        <p>{{ $cartItem['menu']->description }}</p>
                        <p>Price: ${{ $cartItem['price'] }}</p>
                        <p>Quantity: {{ $cartItem['quantity'] }}</p>
                    </div>
                @endforeach
            @else
                <p>Your cart is empty.</p>
            @endif--}}

            <tr>
                <td><label for="PaymentMethod">Select Payment Method:</label></td>

            </tr>

            <tr>
                <td>
                    <select id="PaymentMethod" name="PaymentMethod">
                        <option value="OnlineBanking">Online Banking</option>
                        <option value="CreditCard">Credit Card</option>
                        <option value="DebitCard">Debit Card</option>
                        <option value="Ewallet">E-Wallet</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>
                    <div id="OnlineBankingForm">
                    <!-- Content to be insert from JS -->
                    </div>

                    <div id="CreditCardForm">
                    <!-- Content to be insert from JS -->
                    </div>

                    <div id="DebitCardForm">
                    <!-- Content to be insert from JS -->
                    </div>

                    <div id="EwalletForm">
                    <!-- Content to be insert from JS -->
                    </div>
                </td> 
            </tr>
            
            <tr>
                <td><button type="submit">Comfirm Payment</button></td>
            </tr>
        </table>
    </form>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

</div>

@endsection