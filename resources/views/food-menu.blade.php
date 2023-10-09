@extends('layouts.app')
@section('title', 'Home')
@section('content')

<!-- <head>
    <title>Food Menu</title>
</head>
<body>
    <h1>Food Menu</h1>

    <ul>
        @foreach($foods as $food)
            <li>{{ $food->name }} - {{ $food->description }}</li>
        @endforeach
    </ul>
</body> -->

<head>
    <title>Food Menu</title>
</head>
<body>
    <h1>Food Menu</h1>

    <h2>Menus</h2>
    <ul>
        @foreach($menus as $menu)
            <li>{{ $menu->name }}</li>
        @endforeach
    </ul>

    <h2>Food Items</h2>
    <ul>
        @foreach($foods as $food)
            <li>
                <strong>Name:</strong> {{ $food->name }}<br>
                <strong>Description:</strong> {{ $food->description }}<br>
                <strong>Price:</strong> ${{ $food->price }}<br>
                <strong>Menus:</strong>
                <ul>
                    @foreach($food->menus as $menu)
                        <li>{{ $menu->name }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</body>
@endsection