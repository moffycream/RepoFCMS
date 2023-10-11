@extends('layouts.app')
@section('title', 'Admin-Orders')
@section('content')
<h1 class="title">Add Menu</h1>

<div class="add-menu-container">
    <div class="row-add-menu">
        @php
        $count = 0;
        @endphp

        @foreach($listItems as $menu)
        <div class="col-add-menu">
            <img src="{{$menu->imagePath}}" alt="Image" class="food-logo">
            <div class="col-add-menu-info-row">
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Name</p>
                    <p>{{$menu->name}}</p>
                </div>
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Foods</p>
                    @foreach($menu->foods as $food)
                    <p>
                        {{$food->name}}
                    </p>
                    @endforeach
                </div>
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Price</p>
                    <p>{{$menu->totalPrice}}</p>
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

        <div class="col-add-menu">
            <a href="{{url('add-menu-form')}}">+</a>
        </div>
        @if ($count % 3 !== 0)
        <!-- If there are less than 3 items in the last row, close the row -->
    </div>
    @endif
</div>
@endsection