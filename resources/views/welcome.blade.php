<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include ("include/header")

@forelse ($listItems as $listItem)
<div class="alert alert-primary" role="alert">
    <span>Item: {{ $listItem->name }}</span> 
    <form method="post" action="{{ route('markAsComplete', $listItem->id) }}">
        {{ csrf_field() }}
        <button 
            type="submit" 
            class="btn {{ $listItem->is_complete ? 'btn-success' : 'btn-danger' }}"
        >
            {{ $listItem->is_complete ? 'Completed' : 'Mark as Complete' }}
        </button>
    </form>                    
</div>                
@empty
<div class="alert alert-danger" role="alert">
    No Items Saved Yet
</div>                  
@endforelse
            
<form method="post" action="{{ route('saveItem') }}">
    {{ csrf_field() }}
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="inputPassword6" class="col-form-label">Add New Item:</label>
        </div>
        <div class="col-auto">
            <input type="text" name="name" id="name" class="form-control" aria-describedby="passwordHelpInline">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-secondary">Save item</button>
        </div>
    </div>
</form>

@include ("include/footer")
</html>
