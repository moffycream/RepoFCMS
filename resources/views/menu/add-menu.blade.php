@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h1 class="add-menu-title">Add Menu</h1>

<div class="add-menu-container">
    <div class="row-add-menu">
        @php
        $count = 0;
        @endphp

        <!-- Get each menu from database -->
        @foreach($listItems as $menu)
        <div class="col-add-menu">
            <!-- Display menu image -->
            <img src="{{$menu->imagePath}}" alt="Image" class="food-logo">
            <div class="col-add-menu-info-row">
                <!-- Display menu name -->
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Name</p>
                    <p>{{$menu->name}}</p>
                </div>
                <!-- Display each food in menu -->
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Foods</p>
                    <p>
                        @php
                        $foodNameArray = [];
                        @endphp

                        @foreach($menu->foods as $food)
                        @php
                        array_push($foodNameArray, "{$food->name}");
                        @endphp
                        @endforeach

                        @php
                        $foodNameArray = join(', ', $foodNameArray);
                        echo $foodNameArray;
                        @endphp
                    </p>
                </div>
                <!-- Display menu price -->
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Price</p>
                    <p>RM {{$menu->totalPrice}}</p>
                </div>
            </div>
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

        <!-- The block for user to redirect to add menu form -->
        <div class="col-add-menu">
            <a class="add-menu-button" href="{{url('add-menu-form')}}">+</a>
        </div>
        @if ($count % 3 !== 0)
        <!-- If there are less than 3 items in the last row, close the row -->
    </div>
    @endif
</div>
@endsection