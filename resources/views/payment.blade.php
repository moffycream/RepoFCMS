@extends('layouts.app')
@section('title', 'Payment')
@section('content')

<div class="container-payment-page">

    <h1>Orders:</h1>

    <form id="PaymentForm" method="post" action="{{ route('store-payment') }}"><!-- name at route -->
        @csrf

        @php
            $overallTotalPrice = session('overallTotalPrice', 0);
        @endphp

        <p>Total Price: RM {{ $overallTotalPrice }}</p>

        <table id="payment_form_table">

            <tr>
                <td><label for="PaymentMethod">Select Payment Method:</label></td>

            </tr>

            <tr>
                <td>
                    <select id="PaymentMethod" name="PaymentMethod">
                        <option value="none" disabled selected>Payment method</option>
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

                    <!-- for QR code display -->
                    <div id="qr_code_container"></div>

                    <script>
                        const assetUrl = "{{ asset('images/payment-QR-code.png') }}";
                    </script>
                </td> 
            </tr>
            
            <tr>
                <td><button type="submit">Confirm Payment</button></td>
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