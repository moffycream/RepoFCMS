@extends('layouts.app')
@section('title', 'About')
@section('content')
<div class="container-payment-page">

    <h1>Total Price: ${{ $totalPrice }}</h1>

    <h2>Orders:</h2>

    <ul>
        @foreach ($orders as $order)
            <li>{{ $order->menu_name }} - ${{ $order->total }}</li>
        @endforeach
    </ul>    

    <form method="post" action="{{route('user.register')}}">
    


        <button type="submit">Comfirm Payment</button>
    </form>
</div>
@endsection