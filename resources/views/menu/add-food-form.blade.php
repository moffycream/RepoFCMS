@extends('layouts.app')
@section('title', 'Admin-Orders')
@section('content')

<div class="add-menu-container">
    <form class="add-menu-form" id="add-food-form" method="POST" action="{{ route('food.register') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <p class="add-menu-form-title">Add Food Form</p>
        </div>
        <div>
            <label for="food-image">Image</label><br>
            <input type="file" accept=".png, .jpeg, .jpg" id="food-image" name="image">
        </div>
        <div>
            <label for="food-name">Food name</label><br>
            <input type="" id="food-name" name="name" maxlength="20">
        </div>
        <div class="food-description-div">
            <label for="food-description">Description</label><br>
            <input type="text" id="food-description" name="description" maxlength="40">
        </div>
        <div>
            <label for="food-price">Price</label><br>
            <input type="text" id="food-price" name="price">
        </div>

        <button type="submit">Submit</button>
    </form>
</div>
@endsection