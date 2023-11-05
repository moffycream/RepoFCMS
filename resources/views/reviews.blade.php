@extends('layouts.app')
@section('title', 'Reviews')
@section('content')

@php
$replyID = 0;
@endphp

<!-- When url is reviews/review-form, show the review form -->
<div class="container-reviews">
    <div class="panel">
        <div class="row-first">
            @if (count($reviews) > 0)
            <h1>Reviews</h1>
            <a href="{{url('reviews/review-form')}}">Write a review</a>
            @endif
        </div>
        @forelse($reviews as $review)
        @php
        $username = $review->user->username;
        $time = $review->getTimeDifference();
        $category = $review->reviewCategory;
        $rating = $review->reviewRating;
        $title = $review->reviewTitle;
        $content = $review->reviewContent;
        $reviewID = $review->reviewID;
        $replyID = $reviewID;
        $loggedIn = session()->has('username');
        @endphp
        <div class="row-user-review" id="review-{{$reviewID}}">
            <!-- A container for user profile -->
            <div class="row-container">
                <div class="user-profile">
                    <div class="col-user-profile profile-pic">
                        @php
                        $profilePicture = $review->user->imagePath;
                        @endphp
                        <img src="{{ asset($profilePicture)}}" alt="user-profile">
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
            <div class="row-container no-pad">
                <div class="review-content">
                    <h2>{{$title}}</h2>
                    <p>{{$content}}</p>
                </div>
            </div>
            <div class="row-container no-pad">
                <div class="review-action">
                    <button type="button" onclick="toggleComments('{{$reviewID}}')"><i class="fas fa-comment-alt"></i><span>Comment</span> <span>({{$review->getTotalComments()}})</span></button>
                    <button type="button" onclick="toggleReply('{{$replyID}}')"><i class="fas fa-reply"></i><span>Reply</span></button>
                </div>
                <div class="reply" id="reply-{{$replyID}}">
                    <form method="post" action="{{route('review.submit.comment')}}">
                        @csrf
                        <input type="hidden" name="reviewID" value="{{$review->reviewID}}">
                        <input type="text" name="commentContent" placeholder="Write a comment" value="">
                        @if ($loggedIn)
                        <button type="submit">Send</button>
                        @else
                        <a href="{{url('login')}}" class="login">Login</a>
                        @endif
                    </form>
                </div>
            </div>
            <!-- Comment Session -->
            @foreach ($review->comments as $comment)
            @include('include.comment', ['comment' => $comment, 'replyID' => $replyID])
            @endforeach
      
    </div>

    @empty
    <div class="no-reviews">
        <h2>Oops, it's a bit lonely here...</h2>
        <p>Be the first to share your thoughts and start the conversation! Your review can make a difference.</p>
        <a href="{{url('reviews/review-form')}}" class="btn btn-primary">Write a review</a>
    </div>
    @endforelse
</div>
</div>

@endsection