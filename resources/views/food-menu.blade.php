@extends('layouts.app')
@section('title', 'Food Menu')
@section('content')

<div class="foodMenu container">
    <h1>Food Menu</h1>
    <h2></h2>
    @foreach ($menus as $menu)
        <div class="foodMenu">
            <h3>{{ $menu->name }}</h3>
            <img src="{{ $menu->imagePath }}" alt="{{ $menu->name }}" width="200"> <!-- Display the image -->
            <p>{{ $menu->description }}</p>
            <p>Price: ${{ $menu->totalPrice }}</p>
            <form action="{{ route('food-menu.addToCart') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->menuID }}">
                <button type="submit">Add to cart</button>
            </form>
        </div>
    @endforeach

    <form action="{{ route('food-menu.checkout') }}" method="POST">
        @csrf
        <button type="submit">Checkout</button>
    </form>

    <!-- Display Cart Items -->
    <div id="cartItems">
        <h2>Cart Items</h2>
        
        <ul>
            @foreach ($cart as $item)
                <li>
                {{ $item['menu']->menuID}}- {{ $item['menu']->name }} - Quantity: {{ $item['quantity'] }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function () 
    {
        // When the "Add to Cart" button is clicked, toggle the visibility of cart items.
        $('form[action*="addToCart"]').on("click",function (event) 
        {
            event.preventDefault(); // Prevent form submission
            $('#cartItems').show(); // Show cart items
            console.log('Form submitted'); // Debugging: Check if the form submission event is triggered
        });
    });
</script>

@endsection


