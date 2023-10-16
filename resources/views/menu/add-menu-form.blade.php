@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="add-menu-form-container">
    <form class="add-menu-form" id="add-menu-form" method="POST" action="{{ route('menu.register') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <p class="add-menu-form-title">Add Menu Form</p>
        </div>
        <div>
            <label for="menu-image">Image</label>
            <input type="file" accept=".png, .jpeg, .jpg" id="menu-image" name="image">
        </div>
        <div>
            <input type="text" id="menu-name" name="name" maxlength="20" placeholder="Menu name"><br>
        </div>
        <div id="food-dropdown-list" class="food-dropdown-check-list">
            <span id="food-dropdown-anchor">Select Foods</span>
            <ul>
                @foreach($listItems as $food)
                <li>
                    <input type="checkbox" id="{{$food->foodID}}{{$food->name}}" class="add-menu-checkbox" name="{{$food->foodID}}" value="{{$food->price}}">
                    <label for="{{$food->foodID}}{{$food->name}}">{{$food->name}}</label>
                </li>
                @endforeach
            </ul>
        </div>
        <div>
            <p>Total price: <span id="add-menu-form-price">0</span></p>
        </div>

        <!-- This hidden field will store the total price for form submission -->
        <input type="hidden" name="totalPrice" id="add-menu-form-price-submission" value="0">
        <div id="hidden-inputs-container"></div>


        <button class="admin-register-submit-button" type="submit">Submit</button>
    </form>
</div>
@endsection