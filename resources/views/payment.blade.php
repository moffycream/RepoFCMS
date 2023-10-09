@extends('layouts.app')
@section('title', 'Payment')
@section('content')

<div class="container-payment-page">

    <h1>Orders:</h1>

    <form id="PaymentForm" method="post" action= 'store-payment'><!-- name at route -->
        <table border = 1>

            <tr>
                <td><h1>Total Price: ${{ $totalPrice }}</h1></td>
            </tr>

            <tr>
                <td>
                    <ul>
                        @foreach ($orders as $order)
                            <li>{{ $order->menu_name }} - ${{ $order->total }}</li>
                        @endforeach
                    </ul>  
                </td>
            </tr>

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
</div>

@endsection