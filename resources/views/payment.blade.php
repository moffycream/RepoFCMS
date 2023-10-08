@extends('layouts.app')
@section('title', 'Payment')
@section('content')
<div class="container-payment-page">

    <h1>Total Price: ${{ $totalPrice }}</h1>

    <h2>Orders:</h2>

    <ul>
        @foreach ($orders as $order)
            <li>{{ $order->menu_name }} - ${{ $order->total }}</li>
        @endforeach
    </ul>    

    <form id="PaymentForm" method="post" action="{{route('user.register')}}">

        <label for="PaymentMethod">Select Payment Method:</label>

        <select id="PaymentMethod" name="PaymentMethod">
            <option value="OnlineBanking">Online Banking</option>
            <option value="CreditCard">Credit Card</option>
            <option value="DebitCard">Debit Card</option>
            <option value="Ewallet">E-Wallet</option>
        </select>

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

        <button type="submit">Comfirm Payment</button>

    </form>
</div>
@endsection