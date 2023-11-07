@extends('layouts.app')
@section('title', 'Food Menu')
@section('content')


    <h1>Food Menu</h1>
    <div class="foodMenu container">
        <h2></h2>
        <div class="foodMenu-list">
            @foreach ($menus as $menu)
                <div class="foodMenu-item">
                    <h3>{{ $menu->name }}</h3>
                    <img class="foodMenu-item-image" src="{{ $menu->imagePath }}" alt="{{ $menu->name }}">
                    <p>Price: RM {{ $menu->totalPrice }}</p>
                    <br></br>
                    <p>Foods in this menu:</p>
                    <ul class='foodMenu-foods'>
                        @foreach ($menu->foods as $food)
                            <li>- {{ $food->name }}</li>
                        @endforeach
                    </ul>
                    <br></br>
                    <form action="{{ route('food-menu.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->menuID }}">
                        <button type="submit" class="foodMenu-add-to-cart-button">Add to cart</button>
                    </form>
                </div>
            @endforeach
        </div>

    <!-- Display Cart Items -->
    <div class="foodMenu-cartItems">
        <h2>Cart Items</h2>
        <ul>
            @foreach ($cart as $item)
                <li>
                    {{ $item['menu']->name }} : {{ $item['quantity'] }}
                </li>
            @endforeach
        </ul>
        <br></br>
        <form action="{{ route('food-menu.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="foodMenu-checkout-button">Checkout</button>
        </form>
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


