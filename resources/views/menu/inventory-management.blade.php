@extends('layouts.admin')
@section('title', 'Inventory management')
@section('content')
<h1 class="add-menu-title">Inventory Management</h1>


<div class="add-menu-form-container">

    @if(isset($editNameErrMsg) || isset($editAmountErrMsg))
    <div id="add-menu-error-window">
        <i class="fas fa-times" id="close-window-button"></i>
        @if(isset($editNameErrMsg))
        <p class="inventory-error">{!!$editNameErrMsg!!}</p>
        @endif
        @if(isset($editAmountErrMsg))
        <p class="inventory-error">{!!$editAmountErrMsg!!}</p>
        @endif
    </div>
    @endif

    <table class="inventory-table">
        <tr class="inventory-table-row">
            <th class="inventory-table-title">Ingredient ID</th>
            <th class="inventory-table-title">Ingredient name</th>
            <th class="inventory-table-title">Amount</th>
            <th class="inventory-table-title">Action</th>
        </tr>
        @foreach($listItems as $item)
        <tr class="inventory-table-row">
            <form class="inventory-form" method="POST" action="{{ route('inventory.edit') }}">
                @csrf
                <!-- Inventory ID -->
                <td class="inventory-table-col">
                    <p>{{$item->inventoryID}}</p>
                    <input type="hidden" value="{{ $item->inventoryID }}" name="inventoryID">
                </td>
                <!-- Inventory name -->
                <td class="inventory-table-col">
                    @if(isset($editName))
                    <span class="inventory-value">{{$item->inventoryName}}</span>
                    <input type="text" class="inventory-edit-value" value="{{ $editName }}" name="name">
                    @else
                    <span class="inventory-value">{{$item->inventoryName}}</span>
                    <input type="text" class="inventory-edit-value" value="{{ $item->inventoryName }}" name="name">
                    @endif
                </td>
                <!-- Inventory amount -->
                <td class="inventory-table-col">
                    @if(isset($editAmount))
                    <span class="inventory-value">{{$item->amount}}</span>
                    <input type="number" class="inventory-edit-value" value="{{ $editAmount }}" name="amount">
                    @else
                    <span class="inventory-value">{{$item->amount}}</span>
                    <input type="number" class="inventory-edit-value" value="{{ $item->amount }}" name="amount">
                    @endif
                </td>
                <!-- Action -->
                <td class="inventory-table-col">
                    <a class="inventory-edit-button" href="#"><i class="far fa-edit"></i> Edit</a>
                    <button class="inventory-save-button" type="submit"><i class="fas fa-save"></i> Save</button>
                    <a class="inventory-cancel-button" href="#"><i class="fas fa-ban"></i> Cancel</a>
                    @php
                    $canDelete = true;
                    @endphp

                    @foreach($foodInventory as $foodItem)
                    @if ($foodItem->inventoryID == $item->inventoryID)
                    @if ($foodItem->amount > 0)
                    @php
                    $canDelete = false;
                    @endphp
                    @endif
                    @endif
                    @endforeach


                    @if($canDelete)
                    <a class="inventory-delete-button" href="{{ route('inventory.delete', ['id' => $item->inventoryID]) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash-alt"></i> Delete</a>
                    @else
                    <a class="inventory-delete-button-no" href="{{ route('inventory.delete', ['id' => $item->inventoryID]) }}" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash-alt"></i> Delete</a>
                    @endif
                </td>
            </form>
        </tr>
        @endforeach
        <tr class="inventory-table-row">
            <form method="POST" action="{{ route('inventory.register') }}">
                @csrf
                <td class="inventory-table-col">Add new ingredient</td>
                <!-- name -->
                <td class="inventory-table-col">
                    @if(isset($nameErrMsg))
                    <p>{!!$nameErrMsg!!}</p>
                    @endif
                    @if(isset($name))
                    <input type="text" name="name" placeholder="Ingredient name" value="{{$name}}">
                    @else
                    <input type="text" name="name" placeholder="Ingredient name">
                    @endif
                </td>

                <!-- amount -->
                <td class="inventory-table-col">
                    @if(isset($amountErrMsg))
                    <p>{!!$amountErrMsg!!}</p>
                    @endif
                    @if(isset($amount))
                    <input type="text" name="amount" placeholder="Ingredient amount" value="{{$amount}}">
                    @else
                    <input type="text" name="amount" placeholder="Ingredient amount">
                    @endif
                </td>
                <td class="inventory-table-col"><button class="inventory-add-button" type="submit"><i class="fas fa-plus"></i> Add</button></td>
            </form>
        </tr>
    </table>
</div>

@endsection