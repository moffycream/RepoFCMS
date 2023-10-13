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
            <p>Price: ${{ $menu->totalPrice }}</p>
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

    <div id="cartItems" style="display: none;">
        <h2>Cart Items</h2>
        <ul id="cartItemList"></ul>
    </div>
</div>

@endsection

