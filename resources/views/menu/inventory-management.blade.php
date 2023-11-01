@extends('layouts.admin')
@section('title', 'Inventory management')
@section('content')
<div class="add-menu-form-container">
    <table border="1">
        <tr>
            <th>Ingredient ID</th>
            <th>Ingredient name</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        @foreach($listItems as $item)
        <tr>
            <form class="inventory-form" method="POST" action="{{ route('inventory.edit') }}">
                @csrf
                <!-- Inventory ID -->
                <td>
                    {{$item->inventoryID}}
                    <input type="hidden" value="{{ $item->inventoryID }}" name="inventoryID">
                </td>
                <!-- Inventory name -->
                <td>
                    <span class="inventory-value">{{$item->inventoryName}}</span>
                    <input type="text" class="inventory-edit-value" value="{{ $item->inventoryName }}" name="name">
                </td>
                <!-- Inventory amount -->
                <td>
                    <span class="inventory-value">{{$item->amount}}</span>
                    <input type="text" class="inventory-edit-value" value="{{ $item->amount }}" name="amount">
                </td>
                <!-- Action -->
                <td>
                    <a class="edit-button">Edit</a>
                    <button class="save-button">Save</button>
                    <a class="cancel-button">Cancel</a>
                    <a class="delete-button" href="{{ route('inventory.delete', ['id' => $item->inventoryID]) }}" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                </td>
            </form>
        </tr>
        @endforeach
        <tr>
            <form method="POST" action="{{ route('inventory.register') }}">
                @csrf
                <td>Add new ingredient</td>
                <td><input type="text" name="name"></td>
                <td><input type="text" name="amount"></td>
                <td><button type="submit">+</button></td>
            </form>
        </tr>
    </table>
</div>

<script>
    document.querySelectorAll('.edit-button').forEach(function(button) {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const inventoryValue = row.querySelectorAll('.inventory-value');
            const inventoryEditValue = row.querySelectorAll('.inventory-edit-value');
            const saveButton = row.querySelector('.save-button');
            const cancelButton = row.querySelector('.cancel-button');
            const deleteButton = row.querySelector('.delete-button');

            // Hide the item value and "Edit" button
            inventoryValue.forEach(element => {
                element.style.display = 'none';
            });

            inventoryEditValue.forEach(element => {
                element.style.display = 'block';
            });

            button.style.display = 'none';
            saveButton.style.display = 'block';
            cancelButton.style.display = 'block';
            deleteButton.style.display = 'none';
        });
    });

    document.querySelectorAll('.inventory-form').forEach(function(form){
        form.addEventListener('submit', function(){
            const row = this.closest('tr');
            
        });
    });
</script>

@endsection