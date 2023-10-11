@extends('layouts.app')
@section('title', 'Admin-Orders')
@section('content')
<h1 class="add-menu-title">Add Food</h1>

<div class="add-menu-container">
    <div class="row-add-menu">
        @php
        $count = 0;
        @endphp

        @foreach($listItems as $food)
        <div class="col-add-menu">
            <img src="{{$food->imagePath}}" alt="Image" class="food-logo">
            <div class="col-add-menu-info-row">
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Name</p>
                    <p>{{$food->name}}</p>
                </div>
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Description</p>
                    <p>{{$food->description}}</p>
                </div>
                <div class="col-add-menu-info-col">
                    <p class="col-add-menu-info-title">Price</p>
                    <p>{{$food->price}}</p>
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
            <a href="{{url('add-food-form')}}">+</a>
        </div>
        @if ($count % 3 !== 0)
        <!-- If there are less than 3 items in the last row, close the row -->
    </div>
    @endif
</div>
@endsection