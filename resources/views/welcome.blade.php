@extends('layouts.app')
@section('title', 'Home')
@section('content')

<div class="container-home">
    <div class="row">
        <div>
            <h1>FOOD IS ONLY THE BEGININGING</h1>
            <p>For the price of a table in a restaurant, book a private<br> chef in your own place.</p>
            <a href="url('display-food-menu')">Start Exploring</a>
        </div>
    </div>

    <div class="row section-1">
        <div>
            @if (isset($menuItems))
            @if (count($menuItems) > 0)
            <h2>Our Popular Menus</h2>
            <hr>
            @else
            <h2>Our Menus</h2>
            <hr>
            <p>Savor the extraordinary with FoodEdge menus—where every dish is a masterpiece, meticulously crafted to delight your palate and elevate your dining experience.</p>
            @endif
            @endif
        </div>
        @if (isset($menuItems))
        <div class="container">
            @for ($i = 0; $i < 3; $i++) @if (isset($menuItems[$i])) <div class="card">
                <div>
                    <img src="{{asset($menuItems[$i]->imagePath)}}" alt="menu image">
                </div>
                <div class="container-stars">
                    @for ($j = 0; $j < 5; $j++)
                        @if ($j < $menuItems[$i]->ratings)
                        <i class="fas fa-star"></i>
                        @else
                        <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <h2>{{$menuItems[$i]->name}}</h2>
                <p>RM {{$menuItems [$i]->totalPrice}}</p>
                <a href="{{url('display-food-menu')}}">Order now</a>
        </div>
        @endif
        @endfor
    </div>
    @endif
</div>

<div class="row section-2">
    <h2>IT WAS LOVELY WORKING WITH YOU AND WE REALLY LOVED ALL  <br> THE ATTENTION TO DETAIL YOU PROVIDED.</h2>
</div>

<div class="row section-3">
    <div>
        <h2>Food Edge</h2>
        <hr>
        <p>FoodEdge is events and catering specialist with over 20 years of experience</p>
    </div>
    <div class="container">
        <div class="card">
            <h2>Our Services</h2>
            <p> Elevating Events, Redefining Catering. From exquisite menus to flawless execution, we craft unforgettable experiences. Your occasion, our expertise – the perfect pairing of flavor and finesse.</p>
        </div>
        <div class="card">
            <h2>Event</h2>
            <p>Experience extraordinary events with FoodEdge. From weddings to corporate gatherings, we specialize in turning moments into memories. Impeccable catering, seamless planning – making every occasion exceptional.</p>
        </div>
        <div class="card">
            <h2>Styling</h2>
            <p> Elevate your event with FoodEdge styling. Impeccable design meets seamless execution, ensuring every detail reflects your unique vision. From intimate affairs to grand celebrations, let us bring style to your story.</p>
        </div>
    </div>
</div>
</div>

@endsection