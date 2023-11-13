@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="add-menu-form-container">
    <form class="add-menu-form" id="add-menu-form" method="POST" action="{{ route('menu.register') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <p class="add-menu-form-title">Add Menu Form</p>
        </div>
        <div class="add-menu-form-input-div">
            <label for="menu-image">Image</label>
            @if(isset($imageErrMsg))
            <p class="menu-form-error">{!!$imageErrMsg!!}</p>
            @endif
            <input type="file" accept=".png, .jpeg, .jpg" id="menu-image" name="image">
        </div>
        <div class="add-menu-form-input-div">
            @if(isset($nameErrMsg))
            <p class="menu-form-error">{!!$nameErrMsg!!}</p>
            @endif
            @if(isset($name))
            <input type="text" id="menu-name" name="name" placeholder="Menu name" value="{{$name}}">
            @else
            <input type="text" id="menu-name" name="name" placeholder="Menu name">
            @endif
        </div>
        <div class="food-dropdown-list food-dropdown-check-list">
            @if(isset($checkboxErrMsg))
            <p class="menu-form-error">{!!$checkboxErrMsg!!}</p>
            @endif
            <span class="food-dropdown-anchor">Select Foods</span>
            <ul>
                @foreach($listItems as $food)
                @php
                $value = '';
                @endphp
                @foreach($food->food_inventory as $food_inventory)
                @php
                $value .= $food_inventory->inventoryID . '-' . $food_inventory->amount . '|';
                @endphp
                @endforeach
                <li>
                    <input type="checkbox" id="{{$food->foodID}}" class="add-menu-checkbox" name="{{$food->foodID}}" value="{{$food->price}}|{{$value}}">
                    <label for="{{$food->foodID}}">{{$food->name}}</label>
                </li>
                @endforeach
            </ul>
        </div>
        <div>
            <p>Total price: RM <span id="add-menu-form-price">0</span></p>
        </div>

        <!-- This hidden field will store the total price for form submission -->
        <input type="hidden" name="totalPrice" id="add-menu-form-price-submission" value="0">
        <div id="hidden-inputs-container"></div>

        <div>
            <table class="add-food-ingredient-table">
                <tr>
                    <th>Ingredient ID</th>
                    <th>Ingredient name</th>
                    <th>Amount</th>
                </tr>
                @foreach($inventory as $inventory)
                @if($inventory->isArchive == false)
                <tr>
                    <td>
                        {{$inventory->inventoryID}}
                        <input type="hidden" class="add-menu-required-ingredient-ID" value="{{$inventory->inventoryID}}">
                    </td>
                    <td>{{$inventory->inventoryName}}</td>
                    <td><span class="add-menu-required-ingredient">0</span></td>
                </tr>
                @endif
                @endforeach
            </table>
        </div>

        <button class="admin-register-submit-button" type="submit">Submit</button>
    </form>
</div>
@endsection