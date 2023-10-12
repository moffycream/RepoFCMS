@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<h1></h1>

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
            <input type="text" id="food-name" name="name" maxlength="20" placeholder="Enter food name">
        </div>
        <div class="food-description-div">
            <label for="food-description">Description</label><br>
            <textarea id="food-description" name="description" maxlength="80" rows="3" cols="50" placeholder="Enter food decription"></textarea>
        </div>
        <div>
            <label for="food-price">Price</label><br>
            <input type="text" id="food-price" name="price" maxlength="8" placeholder="Enter food price">
        </div>

        <button type="submit">Submit</button>
    </form>
</div>
@endsection