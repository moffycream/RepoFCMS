@extends('layouts.app')
@section('title', 'Admin-Orders')
@section('content')
<h1 class="title">Add Menu</h1>

<div class="container">
    <form class="register-form" id="add-menu-form" method="POST" action="{{ route('menu.register') }}" enctype="multipart/form-data">
        @csrf
        <label>Image</label>
        <input type="file" accept=".png, .jpeg, .jpg" id="menu-image" name="image"><br>
        <label>Menu name</label>
        <input type="text" id="menu-name" name="name"><br>
        <label>Foods</label>

        @foreach($listItems as $food)
        <input type="checkbox" class="add-menu-checkbox" name="{{$food->foodID}}" value="{{$food->price}}">
        <label>{{$food->name}}</label>

        @endforeach
        <p>Total price: <span id="add-menu-form-price">0</span></p>

        <!-- This hidden field will store the total price for form submission -->
        <input type="hidden" name="totalPrice" id="add-menu-form-price-submission" value="0">
        <div id="hidden-inputs-container"></div>        

        
        <button type="submit">Submit
    </form>
</div>
@endsection