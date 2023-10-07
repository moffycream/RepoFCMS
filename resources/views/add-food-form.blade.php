@extends('layouts.app')
@section('title', 'Admin-Orders')
@section('content')
<h1 class="title">Add Menu</h1>

<div class="container">
    <form class="register-form" method="POST" action="{{ route('food.register') }}" enctype="multipart/form-data">
        @csrf
        <label>Image</label>
        <input type="file" accept=".png, .jpeg, .jpg" id="image" name="image"><br>
        <label>Food name</label>
        <input type="text" id="name" name="name"><br>
        <label>Description</label>
        <input type="text" id="description" name="description"><br>
        <label>Price</label>
        <input type="text" id="price" name="price"><br>
        <button type="submit">Submit
    </form>
</div>
@endsection