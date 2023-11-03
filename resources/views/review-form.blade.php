@extends('layouts.app')
@section('title', 'Review Form')
@section('content')

<div class="container-review-form">
    <div class="panel">
    <h1>Let us know what your think!</h1>
    <form method="post" action="{{ route('review.submit') }}">
        @csrf
        <p>Category *</p>
        <select id="category" name="reviewCategory">
            <option value="" disabled selected>Select a category</option>
            <option value="food">Food</option>
            <option value="service">Service</option>
            <option value="delivery">Delivery</option>
            <option value="others">Others</option>
        </select>

        <p>Your overall rating *</p>
        <div class="container-stars">
            @for ($i = 5; $i >= 1; $i--) 
            <input type="radio" id="{{ $i }}" name="reviewRating" value="{{ $i }}" >
            <label for="{{ $i }}"><i class="fas fa-star"></i></label>
            @endfor
        </div>


        <p>Title of your review *</p>
        <input type="text" id="title" name="reviewTitle" value="" placeholder="Title of your review">

        <p>Your review *</p>
        <textarea id="review" name="reviewContent" placeholder="Your review"></textarea>

        <div>
            <a href="{{route('reviews')}}">Cancel</a>
            <button type="submit">Submit</button>
        </div>
    </form>
    </div>
</div>

@endsection