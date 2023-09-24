<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">            
</head>

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
</html>
