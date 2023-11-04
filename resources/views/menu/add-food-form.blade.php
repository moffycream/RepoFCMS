@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<h1></h1>

<div class="add-menu-form-container">
    <form class="add-menu-form" id="add-food-form" method="POST" action="{{ route('food.register') }}" enctype="multipart/form-data">
        @csrf
        <div>
                <p class="add-menu-form-title">Edit Food Form</p>
        </div>
        <div>
            <label for="menu-image">Image</label>
            <input type="file" accept=".png, .jpeg, .jpg" id="food-image" name="image">
        </div>
        <div>
            <input type="text" id="food-name" name="name" maxlength="20" placeholder="Food name">
        </div>
        <div class="food-description-div">
            <textarea id="food-description" name="description" maxlength="80" rows="3" placeholder="Food decription"></textarea>
        </div>
        <div>
            <input type="text" id="food-price" name="price" maxlength="8" placeholder="Food price">
        </div>
        <div>
            <table>
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