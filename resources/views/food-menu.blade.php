@extends('layouts.app')
@section('title', 'Food Menu')
@section('content')

<div class="foodMenu-main-content-container">
    <div class="foodMenu-title">
        <h2 class="title">Food Menu</h2>
    </div>
<div class="foodMenu container">
    <h2></h2>
    <div class="foodMenu-list">
        <!-- menu stocks -->
        @php
        $menuStocks = [];
        @endphp

        @foreach ($menus as $menu)
        <div class="foodMenu-item">
            <h3>{{ $menu->name }}</h3>
            <img class="foodMenu-item-image" src="{{ $menu->imagePath }}" alt="{{ $menu->name }}">
            <br></br>
            <h3>Foods in this menu:</h3>
            <ul class="foodMenu-foods">
                @foreach ($menu->foods as $food)
                <details>
                    <summary class="food-name left-aligned custom-arrow-summary">{{ $food->name }}</summary>
                    @if (!empty($food->description))
                    <p class="food-description" style="display: none"><small>{{ $food->description }}</small></p>
                    @endif
                </details>
                @endforeach
            </ul>

            <!-- calculate stock -->
            @php
            $inventoryCounts = [];
            $menuStock= [];
            @endphp

            @foreach($menu->foods as $food)
            @foreach($food->food_inventory as $food_inventory)
            @php
            if (array_key_exists($food_inventory->inventoryID, $inventoryCounts)) {
            $inventoryCounts[$food_inventory->inventoryID] += $food_inventory->amount;
            } else {
            $inventoryCounts[$food_inventory->inventoryID] = $food_inventory->amount;
            }
            @endphp
            @endforeach
            @endforeach

            @foreach($inventoryCounts as $inventoryID => $inventoryCount)
            @foreach($food->food_inventory as $food_inventory)
            @foreach($inventories as $inventory)
            @if($food_inventory->inventoryID == $inventoryID && $inventory->inventoryID == $inventoryID && $inventoryCount > 0)
            @php
            $menuStock[] = floor($inventory->amount / $inventoryCount);
            @endphp
            @endif
            @endforeach
            @endforeach
            @endforeach

            @php
            $stock = min($menuStock);
            $menuStocks[$menu->menuID] = $stock;
            @endphp
            <!--end calculate stock -->

            <br></br>
            <p style="text-align: left">Stock: {{$stock}}</p>
            <p>Price: RM {{ $menu->totalPrice }}</p>
            <br></br>
            <form action="{{ route('food-menu.addToCart') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->menuID }}">
                <input type="hidden" name="stock" value="{{ $menuStocks[$menu->menuID] }}">
                <button type="submit" class="foodMenu-add-to-cart-button" 
                        data-stock="{{ $menuStocks[$menu->menuID] }}" @if ($menuStocks[$menu->menuID] <= 0) disabled @endif>
                    Add to cart
                </button>
            </form>
        </div>
        @endforeach
    </div>

    <!-- Display Cart Items -->
    <div class="foodMenu-cartItems">
        <h2>Cart Items</h2>
        <ul>
            @foreach ($cart as $item)
            <li class="foodMenu-cart-item">
                <img src="{{ $item['menu']->imagePath }}" alt="{{ $item['menu']->name }}" class="foodMenu-cart-item-image">
                <div class="foodMenu-cart-item-details">
                    <p><strong>Menu:</strong> {{ $item['menu']->name }}</p>
                    <p><strong>Price:</strong> RM {{ $item['price'] }}</p>
                    <p><strong>Quantity:</strong>
                        <borderless class="quantity-button borderless" data-id="{{ $item['menu']->menuID }}" data-action="decrement" 
                            data-stock="{{ $menuStocks[$menu->menuID] }}">-</borderless>
                        {{ $item['quantity'] }}
                        <borderless class="quantity-button borderless"
                            data-id="{{ $item['menu']->menuID }}"
                            data-action="increment" 
                            data-stock="{{ $menuStocks[$item['menu']->menuID] }}" 
                            data-quantity="{{ $item['quantity'] }}">+</borderless>
                        <red-button class="remove-button red-button" data-id="{{ $item['menu']->menuID }}">Remove</red-button>
                    </p>
                </div>
            </li>
            @endforeach
        </ul>
        <h3><strong>Total Price: RM {{ $totalPrice }}</strong></h3>
        <form action="{{ route('food-menu.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="foodMenu-checkout-button">Checkout</button>
        </form>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() 
    {
        // When the "Add to Cart" button is clicked, toggle the visibility of cart items.
        $('form[action*="addToCart"]').on("click", function(event) 
        {
            event.preventDefault(); // Prevent form submission
            $('#cartItems').show(); // Show cart items
            console.log('Form submitted'); // Debugging: Check if the form submission event is triggered
        });
    });
</script>

<script>
    $(document).ready(function() 
    {
        // Increment quantity
        $('.quantity-button[data-action="increment"]').click(function() 
        {
            var menuID = $(this).data('id');
            var stock = $(this).data('stock');
            var quantityElement = $(this).data('quantity');

            console.log('Menu ID: ', menuID);
            console.log('Current Quantity:', quantityElement);
            console.log('Stock:', stock);

            // Check if the current quantity is less than the stock amount
            if (quantityElement < stock) 
            {
                updateQuantity(menuID, 'increment');
            } 
            else 
            {
                // Optionally, you can display a message or handle this case as needed.
                console.log('Quantity cannot exceed stock amount.');
            }
        });

        // Decrement quantity
        $('.quantity-button[data-action="decrement"]').click(function() 
        {
            var menuID = $(this).data('id');
            updateQuantity(menuID, 'decrement');
        });

        // Remove item
        $('.remove-button').click(function() 
        {
            var menuID = $(this).data('id');
            removeItem(menuID);
        });
    });

    function updateQuantity(menuID, action) 
    {
        var csrfToken = '{{ csrf_token() }}';

        console.log('Updating quantity for menuID:', menuID);
        console.log('CSRF Token:', csrfToken);

        $.ajax({
            type: 'POST',
            url: '{{ route("food-menu.updateCart") }}',
            data: {
                _token: csrfToken,
                menu_id: menuID,
                action: action
            },
            success: function(response) 
            {
                if (response.success) 
                {
                    // Reload the page or update the cart display
                    location.reload();
                } 
                else 
                {
                    console.error('Error updating quantity:', response.message);
                }
            },
            error: function(xhr, status, error) 
            {
                console.error('AJAX error:', error);
            }
        });
    }


    function removeItem(menuID) 
    {
        $.ajax({
            type: 'POST',
            url: '{{ route("food-menu.removeFromCart") }}',
            data: {
                _token: '{{ csrf_token() }}',
                menu_id: menuID
            },
            success: function(response) 
            {
                if (response.success) 
                {
                    // Reload the page or update the cart display
                    location.reload();
                } 
                else 
                {
                    console.error('Error removing item:', response.message);
                }
            },
            error: function(xhr, status, error) 
            {
                console.error('AJAX error:', error);
            }
        });
    }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() 
    {
        $('form[action*="addToCart"]').on("submit", function(event) 
        {
            event.preventDefault(); // Prevent form submission
            var $form = $(this);
            var stock = $form.find('.foodMenu-add-to-cart-button').data('stock');

            if (stock > 0) 
            {
                // Submit the form to add to the cart
                $.ajax({
                    type: 'POST',
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function(response) 
                    {
                        
                        // Update the cart and available stock
                        $form.find('.foodMenu-add-to-cart-button').data('stock', stock - 1);
                        updateStockDisplay(stock - 1);
                    }
                });
            }
        });
    });

    function updateStockDisplay(stock) 
    {
        // Update the displayed stock for all buttons
        $('.foodMenu-add-to-cart-button').each(function() 
        {
            var $button = $(this);
            $button.data('stock', stock);
            if (stock <= 0) 
            {
                $button.attr('disabled', true);
            } 
            else 
            {
                $button.removeAttr('disabled');
            }
        });
    }
</script>

<script>
    $(document).ready(function() 
    {
        $('.food-name').click(function() 
        {
            $(this).next('.food-description').toggle();
        });
    });
</script>
@endsection