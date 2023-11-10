@extends('layouts.app')
@section('title', 'Food Menu')
@section('content')

<div class="foodMenu-main-content-container">
    <div class="foodMenu-title">
        <h2>Food Menu</h2>
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
                        <borderless class="quantity-button borderless" data-id="{{ $item['menu']->menuID }}" data-action="decrement">-</borderless>
                        {{ $item['quantity'] }}
                        <borderless class="quantity-button borderless" data-id="{{ $item['menu']->menuID }}" data-action="increment">+</borderless>
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
            updateQuantity(menuID, 'increment');
            console.log('+ Button clicked');
        });

        // Decrement quantity
        $('.quantity-button[data-action="decrement"]').click(function() 
        {
            var menuID = $(this).data('id');
            updateQuantity(menuID, 'decrement');
            console.log('- Button clicked');
        });

        // Remove item
        $('.remove-button').click(function() 
        {
            var menuID = $(this).data('id');
            removeItem(menuID);
            console.log('Remove Button clicked');
        });
    });

    function updateQuantity(menuID, action) 
    {
    $.ajax({
        type: 'POST',
        url: '/update',
        data: {
            _token: '{{ csrf_token() }}',
            menu_id: menuID,
            action: action
        },
        success: function(response) 
        {
            if (response.success) 
            {
                // Update the quantity displayed in the cart
                // You can also update the total price here
                // Example: Update the quantity for the specific item in the cart
                const $cartItem = $('.foodMenu-cart-item[data-id="' + menuID + '"]');
                const $quantityElement = $cartItem.find('.foodMenu-cart-item-quantity');
                const currentQuantity = parseInt($quantityElement.text());
                if (action === 'increment') 
                {
                    $quantityElement.text(currentQuantity + 1);
                    console.log('Quantity added by 1');
                } 
                else if (action === 'decrement' && currentQuantity > 1) 
                {
                    $quantityElement.text(currentQuantity - 1);
                    console.log('Quantity deducted by 1');
                }
            }
        }
    });
}


    function removeItem(menuID) 
    {
        $.ajax({
            type: 'POST',
            url: '/remove', 
            data: 
            {
                _token: '{{ csrf_token() }}',
                menu_id: menuID
            },
            success: function (response) 
            {
                if (response.success) 
                {
                    array_splice($cart, $cartItemIndex, 1);
                    console.log('Item removed');
                    // You may need to reload the cart or update it via JavaScript
                }
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