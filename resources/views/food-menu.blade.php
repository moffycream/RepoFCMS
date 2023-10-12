@extends('layouts.app')
@section('title', 'Home')
@section('content')

<div class="foodMenu container">
    <h1>Food Menu</h1>

    <h2></h2>
    @foreach ($menus as $menu)
        <div class="foodMenu">
            <h3>{{ $menu->name }}</h3>
            <p>{{ $menu->description }}</p>
            <p>Price: ${{ $menu->price }}</p>
            <form action="{{ route('food-menu.addToCart') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <button type="submit">Add to cart</button>
            </form>
        </div>
    @endforeach

    <form action="{{ route('food-menu.checkout') }}" method="POST">
        @csrf
        <button type="submit">Checkout</button>
    </form>

    <h2>Cart Items</h2>
    @if (count($cart ?? []) > 0)
        <ul>
            @foreach ($cart as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>

@endsection
