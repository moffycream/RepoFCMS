@extends('layouts.app')
@section('title', 'Payment')
@section('content')

<div class="container-payment-page">

    <h1>Payment</h1>

    @php
        $overallTotalPrice = session('overallTotalPrice', 0);
    @endphp

        <div id='container-payment-show-payment'>
            <table>
                <tr>
                    <td>
                        <p>Order Total Price: </p>
                    </td>

                    <td>
                        <!-- Display the total amount -->
                        @if($overallTotalPrice > 0)
                            <p id='payment-total-price'>RM {{ $overallTotalPrice }}</p>
                        @else
                            <p id='payment-total-price'>RM: -</p>
                        @endif
                    </td>

                </tr>

                <tr>
                    <td>
                        <p>Discount Given: -</p>
                    </td>

                    <td>
                        @if(isset($membership))
                            @if($membership->isNotEmpty())
                                <ul>
                                    @foreach($membership as $member)
                                        <p>RM {{ $member->discount_amount }}</p>
                                    @endforeach
                                </ul>
                            @else
                                <!-- Membership data is not available -->
                                <p>No Membership Data</p>
                            @endif
                        @else
                            <p>No data available</p>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>
                        <p>Total Price:</p>
                    </td>

                    <td>
                        <!-- Total price after discount -->
                        @if($overallTotalPrice > 0 && isset($membership) && $membership->isNotEmpty())
                            @foreach($membership as $member)
                                <p>RM {{ $overallTotalPrice - $member->discount_amount }}</p>
                            @endforeach
                        @else
                            <p>RM: -</p>
                        @endif                    
                    </td>
                </tr>
            </table>
        </div>

    <form id="PaymentForm" method="post" action="{{ route('payment.store') }}"><!-- name at route -->
        @csrf

        {{-- Hidden input field to store the value of the overallTotalPrice --}}
        <input id="payment_overall_total_price" type="hidden" name="overallTotalPrice" value="{{ session('totalPrice') }}">
        <input type="hidden" name="orderID" value="{{session('orderID')}}">

        @foreach(session('menuIDs', []) as $menuID)
            <input type="hidden" name="menuIDs[]" value="{{ $menuID }}">
        @endforeach

        @foreach(session('menuQuantities', []) as $menuQuantity)
            <input type="hidden" name="menuQuantities[]" value="{{ $menuQuantity }}">
        @endforeach

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
                    <div id="payment_paymentMethod_error" class="payment_error"></div>
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
                <td><label class='payment-form-payment-amount' for="payment_amount">Amount: </label></td>
            </tr>

            <tr>
                <td>
                    <div class='payment-form-payment-amount'>
                        <input type="text" id="payment_amount" name="payment_amount" placeholder="Amount" value="{{ session('totalPrice') }}" readonly required>
                    </div>
                </td>
            </tr>

            <tr>
                <td><button type="submit">Confirm Payment</button></td>
            </tr>
        </table>
    </form>

</div>

@endsection