@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="add-menu-container">
    <form class="add-menu-form" id="add-menu-form" method="POST" action="{{ route('menu.register') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <p class="add-menu-form-title">Add Menu Form</p>
        </div>
        <div>
            <label for="menu-image">Image</label><br>
            <input type="file" accept=".png, .jpeg, .jpg" id="menu-image" name="image"><br>
        </div>
        <div>
            <label for="menu-name">Menu name</label><br>
            <input type="text" id="menu-name" name="name" maxlength="20"><br>
        </div>
        <div>
            <label>Foods</label><br>
            @foreach($listItems as $food)
            <input type="checkbox" id="{{$food->foodID}}{{$food->name}}" class="add-menu-checkbox" name="{{$food->foodID}}" value="{{$food->price}}">
            <label for="{{$food->foodID}}{{$food->name}}">{{$food->name}}</label>
            @endforeach
        </div>
        <div>
            <p>Total price: <span id="add-menu-form-price">0</span></p>
        </div>

        <!-- This hidden field will store the total price for form submission -->
        <input type="hidden" name="totalPrice" id="add-menu-form-price-submission" value="0">
        <div id="hidden-inputs-container"></div>


        <button type="submit">Submit</button>
    </form>
</div>
@endsection