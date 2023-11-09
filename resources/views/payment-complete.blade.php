@extends('layouts.app')
@section('title', 'Payment successful')
@section('content')

<div class="container-payment-successful">
    <h1>Payment successful!</h1><br>
    <p>Head back to the food menu page!</p>
    <a href="{{url('display-food-menu')}}" class="button">Food Menu</a>
</div>

@endsection