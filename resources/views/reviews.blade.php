@extends('layouts.app')
@section('title', 'Reviews')
@section('content')


<!-- When url is reviews/review-form, show the review form -->
<div class="container-reviews">
    <div class="panel">
        <div class="row-first">
            <h1>Reviews</h1>
            <a href="{{url('reviews/review-form')}}">Write a review</a>
        </div>
        @foreach($reviews as $review)
        @php
        $username = $review->user->username;
        $time = $review->getTimeDifference();
        $category = $review->reviewCategory;
        $rating = $review->reviewRating;
        $title = $review->reviewTitle;
        $content = $review->reviewContent;
        @endphp
        <div class="row-user-review">
            <!-- A container for user profile -->
            <div class="row-container">
                <div class="user-profile">
                    <div class="col-user-profile profile-pic">
                        <img src="https://i.imgur.com/6VBx3io.png" alt="user-profile">
                    </div>
                    <div class="col-user-profile">
                        <h3 class="row-user-profile">{{$username}}<span><span class="review-time">{{$time}}</span> | <span class="review-category">{{$category}}</span></span></h3>
                        <div class="row-user-profile container-stars">
                            @for($i = 0; $i < $rating; $i++) <i class="fas fa-star"></i>
                                @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-container">
                <div class="review-content">
                    <h2>{{$title}}</h2>
                    <p>{{$content}}</p>
                </div>
            </div>
            <div class="row-container">
                <div class="review-action">
                    <a href="#"><i class="fas fa-comment-alt"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection