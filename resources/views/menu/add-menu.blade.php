@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<h1 class="add-menu-title">Add Menu</h1>

<div class="add-menu-container">
    @if(isset($editNameErrMsg) || isset($editCheckboxErrMsg))
    <div id="add-menu-error-window">
        <i class="fas fa-times" id="close-window-button"></i>
        @if(isset($editNameErrMsg))
        <p>{!!$editNameErrMsg!!}</p>
        @endif
        @if(isset($editCheckboxErrMsg))
        <p>{!!$editCheckboxErrMsg!!}</p>
        @endif
    </div>
    @endif

    <div class="row-add-menu">
        @php
        $count = 0;
        @endphp

        <!-- Get each menu from database -->
        @foreach($listItems as $menu)
        <div class="col-add-menu">
            <form class="add-food-edit-form" method="POST" action="{{ route('menu.edit')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="menuID" value="{{$menu->menuID}}">

                <!-- Display menu image -->
                <img src="{{$menu->imagePath}}" alt="Image" class="food-logo">

                <div>
                    <input type="file" class="add-menu-edit-value" accept=".png, .jpeg, .jpg" id="food-image" name="image">
                    <p class="add-menu-edit-button" href="#"><i class="far fa-edit"></i> Edit</p>
                    <button class="add-menu-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                    <p class="add-menu-cancel-button" href="#"><i class="fas fa-ban"></i> Cancel</p>
                </div>

                <div class="col-add-menu-info-row">
                    <!-- Display menu name -->
                    <div class="col-add-menu-info-col">
                        <section class="col-add-menu-info-col1">
                            <p class="col-add-menu-info-title">Name</p>
                            <p class="add-menu-value">{{$menu->name}}</p>
                            <input type="text" class="add-menu-edit-value" name="name" value="{{$menu->name}}">
                        </section>
                        <section class="col-add-menu-info-col2">
                            <p class="add-menu-edit-button"><i class="far fa-edit"></i> Edit</p>
                            <button class="add-menu-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                            <p class="add-menu-cancel-button"><i class="fas fa-ban"></i> Cancel</p>
                        </section>
                    </div>
                    <!-- Display each food in menu -->
                    <div class="col-add-menu-info-col">
                        <section class="col-add-menu-info-col1">
                            <p class="col-add-menu-info-title">Foods</p>
                            <p class="add-menu-value">
                                @php
                                $foodNameArray = [];
                                @endphp

                                @foreach($menu->foods as $food)
                                @php
                                array_push($foodNameArray, "{$food->name}");
                                @endphp
                                @endforeach

                                @php
                                $foodNameArray = join(', ', $foodNameArray);
                                echo $foodNameArray;
                                @endphp
                            </p>
                            <div class="food-dropdown-list food-dropdown-check-list add-menu-edit-value">
                                <span class="food-dropdown-anchor">Select Foods</span>
                                <ul>
                                    @foreach($foods as $food)
                                    @php
                                    $hasMatch = false;
                                    @endphp
                                    <li>
                                        @foreach($menu->menu_foods as $menu_food)
                                        @if($food->foodID == $menu_food->foodID)
                                        <input type="checkbox" id="{{$food->foodID}}" class="add-menu-checkbox" name="foodID[]" value="{{$food->foodID}}" checked>
                                        @php
                                        $hasMatch = true;
                                        @endphp
                                        @endif
                                        @endforeach

                                        @if(!$hasMatch)
                                        <input type="checkbox" id="{{$food->foodID}}" class="add-menu-checkbox" name="foodID[]" value="{{$food->foodID}}">
                                        @endif
                                        <label for="{{$food->foodID}}">{{$food->name}}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                        <section class="col-add-menu-info-col2">
                            <p class="add-menu-edit-button"><i class="far fa-edit"></i> Edit</p>
                            <button class="add-menu-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                            <p class="add-menu-cancel-button"><i class="fas fa-ban"></i> Cancel</p>
                        </section>

                    </div>
                    <!-- Display total required ingredient -->
                    <div>
                        <table class="add-food-table-value">
                            <tr class="add-menu-table-row">
                                <th class="add-menu-table-title">Ingredient ID</th>
                                <th class="add-menu-table-title">Ingredient name</th>
                                <th class="add-menu-table-title">Amount</th>
                            </tr>
                        <p class="col-add-menu-info-title">Required ingredients</p>
                        @php
                        $inventoryCounts = [];
                        @endphp

                        @foreach($menu->foods as $food)
                        @foreach($food->food_inventory as $inventory)
                        @php
                        $inventoryID = $inventory->inventoryID;
                        $inventoryCount = $inventory->amount;

                        if (array_key_exists($inventoryID, $inventoryCounts)) {
                        $inventoryCounts[$inventoryID] += $inventoryCount;
                        } else {
                        $inventoryCounts[$inventoryID] = $inventoryCount;
                        }
                        @endphp
                        @endforeach
                        @endforeach

                        @foreach($inventoryCounts as $inventoryID => $inventoryCount)
                        @if ($inventoryCount > 0)
                        @php
                        $ingredient = $inventories->where('inventoryID', $inventoryID)->first();
                        @endphp

                        <tr class="add-menu-table-row">
                            <!-- Inventory ID -->
                            <td class="add-menu-table-col">
                                <span>{{$ingredient->inventoryID}}</span>
                            </td>
                            <!-- Inventory name -->
                            <td class="add-menu-table-col">
                                <span>{{$ingredient->inventoryName}}</span>
                            </td>
                            <!-- Inventory amount -->
                            <td class="add-menu-table-col">
                                <span>{{$inventoryCount}}</span>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        </table>
                    </div>
                    <!-- Display menu price -->
                    <div class="col-add-menu-info-col">
                        <section class="col-add-menu-info-col1">
                        <p class="col-add-menu-info-title">Price</p>
                        <p>RM {{$menu->totalPrice}}</p>
                        </section>
                    </div>
                </div>
            </form>
            <a class="menu-delete-button" href="{{ route('menu.delete', ['id' => $menu->menuID]) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash-alt"></i> Delete</a>

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

        <!-- The block for user to redirect to add menu form -->
        <div class="col-add-menu">
            <a class="add-menu-button" href="{{url('add-menu-form')}}">+</a>
        </div>
        @if ($count % 3 !== 0)
        <!-- If there are less than 3 items in the last row, close the row -->
    </div>
    @endif
</div>
@endsection