@extends('layouts.admin')
@section('title', 'Inventory management')
@section('content')
<h1 class="add-menu-title">Inventory Management</h1>


<div class="add-menu-form-container">
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
                    <span class="inventory-value">{{$item->inventoryName}}</span>
                    <input type="text" class="inventory-edit-value" value="{{ $item->inventoryName }}" name="name">
                </td>
                <!-- Inventory amount -->
                <td class="inventory-table-col">
                    <span class="inventory-value">{{$item->amount}}</span>
                    <input type="text" class="inventory-edit-value" value="{{ $item->amount }}" name="amount">
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
                        @php
                        echo "<a class='inventory-delete-button' href='" . route('inventory.delete', ['id' => $item->inventoryID]) . "' onclick=\"return confirm('Are you sure you want to delete this record?')\"><i class='fas fa-trash-alt'></i> Delete</a>";
                        @endphp
                    @else
                        @php
                        echo '<a class="inventory-delete-button-no"><i class="fas fa-trash-alt"></i> Delete</a>';
                        @endphp
                    @endif
                </td>
            </form>
        </tr>
        @endforeach
        <tr class="inventory-table-row">
            <form method="POST" action="{{ route('inventory.register') }}">
                @csrf
                @method('PUT')
                <td class="inventory-table-col">Add new ingredient</td>
                <td class="inventory-table-col"><input type="text" name="name"></td>
                <td class="inventory-table-col"><input type="text" name="amount"></td>
                <td class="inventory-table-col"><button class="inventory-add-button" type="submit"><i class="fas fa-plus"></i> Add</button></td>
            </form>
        </tr>
    </table>
</div>

<script>
   
</script>

@endsection