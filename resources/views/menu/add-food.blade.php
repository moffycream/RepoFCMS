@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h1 class="add-menu-title">Add Food</h1>

<div class="add-menu-container">
    @if(isset($editNameErrMsg) || isset($editDescriptionErrMsg) || isset($editPriceErrMsg) || isset($editAmountErrMsg))
    <div id="add-menu-error-window">
        <i class="fas fa-times" id="close-window-button"></i>
        @if(isset($editNameErrMsg))
        <p>{!!$editNameErrMsg!!}</p>
        @endif
        @if(isset($editDescriptionErrMsg))
        <p>{!!$editDescriptionErrMsg!!}</p>
        @endif
        @if(isset($editPriceErrMsg))
        <p>{!!$editPriceErrMsg!!}</p>
        @endif
        @if(isset($editAmountErrMsg))
        <p>{!!$editAmountErrMsg!!}</p>
        @endif
    </div>
    @endif

    <div class="row-add-menu">
        @php
        $count = 0;
        @endphp

        <!-- Get each food from database -->
        @foreach($listItems as $food)
        <!-- Block of display food image and details -->
        <div class="col-add-menu">
            <!-- Display food image -->
            <img src="{{$food->imagePath}}" alt="Image" class="food-logo">
            <form class="add-food-edit-form" method="POST" action="{{ route('food.edit')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="foodID" value="{{$food->foodID}}">



                <div>
                    <input type="file" class="add-menu-edit-value" accept=".png, .jpeg, .jpg" id="food-image" name="image">
                    <p class="add-menu-edit-button" href="#"><i class="far fa-edit"></i> Edit</p>
                    <button class="add-menu-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                    <p class="add-menu-cancel-button" href="#"><i class="fas fa-ban"></i> Cancel</p>
                </div>

                <div class="col-add-menu-info-row">
                    <!-- Display food name -->
                    <div class="col-add-menu-info-col">
                        <section class="col-add-menu-info-col1">
                            <p class="col-add-menu-info-title">Name</p>
                            <p class="add-menu-value">{{$food->name}}</p>
                            <input type="text" class="add-menu-edit-value" name="name" value="{{$food->name}}">
                        </section>
                        <section class="col-add-menu-info-col2">
                            <p class="add-menu-edit-button"><i class="far fa-edit"></i> Edit</p>
                            <button class="add-menu-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                            <p class="add-menu-cancel-button"><i class="fas fa-ban"></i> Cancel</p>
                        </section>
                    </div>
                    <!-- Display food description -->
                    <div class="col-add-menu-info-col">
                        <section class="col-add-menu-info-col1">
                            <p class="col-add-menu-info-title">Description</p>
                            <p class="add-menu-value">{{$food->description}}</p>
                            <input type="text" class="add-menu-edit-value" name="description" value="{{$food->description}}">
                        </section class="col-add-menu-info-col2">
                        <section class="col-add-menu-info-col2">
                            <p class="add-menu-edit-button"><i class="far fa-edit"></i> Edit</p>
                            <button class="add-menu-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                            <p class="add-menu-cancel-button"><i class="fas fa-ban"></i> Cancel</p>
                        </section>
                    </div>
                    <!-- Display food price -->
                    <div class="col-add-menu-info-col">
                        <section class="col-add-menu-info-col1">
                            <p class="col-add-menu-info-title">Price</p>
                            <p class="add-menu-value">RM {{$food->price}}</p>
                            <input type="text" class="add-menu-edit-value" name="price" value="{{$food->price}}">
                        </section>
                        <section class="col-add-menu-info-col2">
                            <p class="add-menu-edit-button"><i class="far fa-edit"></i> Edit</p>
                            <button class="add-menu-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                            <p class="add-menu-cancel-button"><i class="fas fa-ban"></i> Cancel</p>
                        </section>
                    </div>
                    <div class="col-add-menu-info-col">
                        <section class="col-add-menu-info-col1">
                            <p class="col-add-menu-info-title">Required ingredients</p>
                            @php
                            $food_count = count($food->food_inventory);
                            @endphp

                            <table class="add-food-table-value add-menu-value">
                                <tr class="add-menu-table-row">
                                    <th class="add-menu-table-title">Ingredient ID</th>
                                    <th class="add-menu-table-title">Ingredient name</th>
                                    <th class="add-menu-table-title">Amount</th>
                                </tr>
                                @for ($i = 0; $i < $food_count; $i++) @php $ingredient=$food->food_inventory[$i];
                                    $name = $ingredient->inventory;
                                    @endphp
                                    @if($ingredient->amount > 0)

                                    <tr class="add-menu-table-row">
                                        @csrf
                                        <!-- Inventory ID -->
                                        <td class="add-menu-table-col">
                                            <span>{{$ingredient->inventoryID}}</span>
                                        </td>
                                        <!-- Inventory name -->
                                        <td class="add-menu-table-col">
                                            <span>{{$name->inventoryName}}</span>
                                        </td>
                                        <!-- Inventory amount -->
                                        <td class="add-menu-table-col">
                                            <span>{{$ingredient->amount}}</span>
                                        </td>
                                    </tr>
                                    @endif
                                    @endfor
                            </table>

                            <table class="add-food-table-edit add-menu-edit-value">
                                <tr class="add-menu-table-row">
                                    <th class="add-menu-table-title">Ingredient ID</th>
                                    <th class="add-menu-table-title">Ingredient name</th>
                                    <th class="add-menu-table-title">Ingredient amount</th>
                                </tr>
                                @foreach ($inventories as $inventory)
                                @if ($inventory->isArchive == false)
                                <tr class="add-menu-table-row">
                                    <!-- Inventory ID -->
                                    <td class="add-menu-table-col">
                                        <span>{{$inventory->inventoryID}}</span>
                                    </td>
                                    <!-- Inventory name -->
                                    <td class="add-menu-table-col">
                                        <span>{{$inventory->inventoryName}}</span>
                                    </td>
                                    <!-- Inventory amount -->
                                    <td class="add-menu-table-col">
                                        @php
                                        $hasMatch = false;
                                        @endphp
                                        @foreach ($food->food_inventory as $food_inventory)
                                        @if ($food_inventory->inventoryID == $inventory->inventoryID)
                                        <input name="amount[]" type="number" value="{{$food_inventory->amount}}">
                                        @php
                                        $hasMatch = true;
                                        @endphp
                                        @endif
                                        @endforeach
                                        @if (!$hasMatch)
                                        <input name="amount[]" type="text" value="0">
                                        @endif
                                        <input type="hidden" name="inventoryID[]" value="{{$inventory->inventoryID}}">
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </table>
                        </section>
                        <section class="col-add-menu-info-col2">
                            <p class="add-menu-edit-button"><i class="far fa-edit"></i> Edit</p>
                            <button class="add-menu-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                            <p class="add-menu-cancel-button"><i class="fas fa-ban"></i> Cancel</p>
                        </section>
                        @php
                        $canDelete = true;
                        @endphp

                    </div>
                </div>
            </form>
            @foreach($menuFoods as $menuFood)
            @if ($menuFood->foodID == $food->foodID)
            @php
            $canDelete = false;
            @endphp
            @endif
            @endforeach

            @if($canDelete)
            <a class="menu-delete-button" href="{{ route('food.delete', ['id' => $food->foodID]) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash-alt"></i> Delete</a>
            @else
            <a class="menu-delete-button-no"><i class="fas fa-trash-alt"></i> Delete</a>
            @endif
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

        <!-- The block for user to redirect to add food form -->
        <div class="col-add-menu">
            <a class="add-menu-button" href="{{url('add-food-form')}}">+</a>
        </div>
        @if ($count % 3 !== 0)
        <!-- If there are less than 3 items in the last row, close the row -->
    </div>
    @endif
</div>
@endsection