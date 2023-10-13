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

    <div id="cartItems">
        <h2>Cart Items</h2>
        <ul id="cartItemList"></ul>
    </div>
</div>

<script>
    $(document).ready(function () 
    {
        // When the "Add to Cart" button is clicked, toggle the visibility of cart items.
        $('form[action*="addToCart"]').submit(function (event) 
        {
            event.preventDefault(); // Prevent form submission
            $('#cartItems').show(); // Show cart items
            console.log('Form submitted'); // Debugging: Check if the form submission event is triggered

            // Add logic to update the cart items list here (you may use AJAX to fetch and display cart contents).
            // console.log('Update cart items'); // Debugging: Check if this part is executing
        });
    });
</script>

@endsection

