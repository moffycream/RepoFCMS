@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<h1></h1>

<div class="add-menu-form-container">
    <form class="add-menu-form" id="add-food-form" method="POST" action="{{ route('food.register') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <p class="add-menu-form-title">Add Food Form</p>
        </div>
        <div class="add-menu-form-input-div">
            <label for="menu-image">Image</label>
            @if(isset($imageErrMsg))
            <p>{!!$imageErrMsg!!}</p>
            @endif
            <input type="file" accept=".png, .jpeg, .jpg" id="food-image" name="image">
        </div>
        <div class="add-menu-form-input-div">
            @if(isset($nameErrMsg))
            <p>{!!$nameErrMsg!!}</p>
            @endif
            @if(isset($name))
            <input type="text" id="food-name" name="name" placeholder="Food name" value="{{$name}}">
            @else
            <input type="text" id="food-name" name="name" placeholder="Food name">
            @endif
        </div>
        <div class="add-menu-form-input-div">
            @if(isset($descriptionErrMsg))
            <p>{!!$descriptionErrMsg!!}</p>
            @endif
            @if(isset($description))
            <textarea id="food-description" name="description" rows="3" placeholder="Food decription">{{$description}}</textarea>
            @else
            <textarea id="food-description" name="description" rows="3" placeholder="Food decription"></textarea>
            @endif
        </div>
        <div class="add-menu-form-input-div">
            @if(isset($priceErrMsg))
            <p>{!!$priceErrMsg!!}</p>
            @endif
            @if(isset($price))
            <input type="text" id="food-price" name="price" placeholder="Food price" value="{{$price}}">
            @else
            <input type="text" id="food-price" name="price" placeholder="Food price">
            @endif
        </div>
        <div class="add-menu-form-input-div">
            @if(isset($amountErrMsg))
            <p>{!!$amountErrMsg!!}</p>
            @endif
            <table class="add-food-ingredient-table">
                <tr>
                    <th>Ingredient ID</th>
                    <th>Ingredient name</th>
                    <th>Ingredient amount</th>
                </tr>
                @foreach($listItems as $item)
                <tr>
                    <td>{{$item->inventoryID}}</td>
                    <td>{{$item->inventoryName}}</td>
                    <td>
                        <input type="hidden" name="inventoryID[]" value="{{$item->inventoryID}}">
                        <input id="{{$item->inventoryID}}" name="amount[]" type="text" value="0">
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <button class="admin-register-submit-button" type="submit">Submit</button>
    </form>
</div>
@endsection