@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <h1>Food Menu</h1>

    <h2></h2>
    @foreach ($menus as $menu)
        <div>
            <h3>{{ $menu->name }}</h3>
            <p>{{ $menu->description }}</p>
            <p>Price: ${{ $menu->price }}</p>
            <form action="{{ route('food-menu.addToCart') }}" method="POST">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <button type="submit">Add to cart</button>
            </form>
        </div>
    @endforeach
@endsection
