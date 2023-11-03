@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h1 class="add-menu-title">Add Food</h1>

<div class="add-menu-container">
    <div class="row-add-menu">
        @php
        $count = 0;
        @endphp

        <!-- Get each food from database -->
        @foreach($listItems as $food)
        <!-- Block of display food image and details -->
        <div class="col-add-menu">
            <!-- Display food image -->
            <img src="{{$food->imagePath}}" alt="Image" class="food-logo">
            <div class="col-add-menu-info-row">
                <!-- Display food name -->
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Name</p>
                    <p>{{$food->name}}</p>
                </div>
                <!-- Display food description -->
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Description</p>
                    <p>{{$food->description}}</p>
                </div>
                <!-- Display food price -->
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Price</p>
                    <p>RM {{$food->price}}</p>
                </div>
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Required ingredients</p>
                    @php
                    $food_count = count($food->food_inventory);
                    @endphp

                    @for ($i = 0; $i < $food_count; $i++) 
                    @php 
                        $ingredient = $food->food_inventory[$i];
                        $name = $ingredient->inventory;
                    @endphp
                    @if($ingredient->amount > 0)
                        {{ $name->inventoryName }}
                        {{ $ingredient->amount }}
                    @endif
                    @endfor

                </div>
            </div>
            <form method="GET" action="{{ route('food.editFood')}}" enctype="text/plain">
                @csrf
                <input type="hidden" name="foodID" value="{{$food->foodID}}">
                <button type="submit" class="edit-menu-button">Edit</button>
            </form>
        </div>

        @php
        $count++;
        if ($count % 3 === 0) {
        echo '
    </div>
    <div class="row-add-menu">';
        }
        @endphp

        @endforeach

        <!-- The block for user to redirect to add food form -->
        <div class="col-add-menu">
            <a class="add-menu-button" href="{{url('add-food-form')}}">+</a>
        </div>
        @if ($count % 3 !== 0)
        <!-- If there are less than 3 items in the last row, close the row -->
    </div>
    @endif
</div>
@endsection