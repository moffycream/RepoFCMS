@extends('layouts.customer')
@section('title', 'Review history')
@section('content')
<div class="container-review-history">
    <h1>Review History</h1>

    @php
    $replyID = 0;
    @endphp

    @forelse($reviews as $review)
    @php
    $username = $review->user->username;
    $time = $review->getTimeDifference();
    $category = $review->reviewCategory;
    $rating = $review->reviewRating;
    $title = $review->reviewTitle;
    $content = $review->reviewContent;
    $reviewID = $review->reviewID;
    $replyID = $review->reviewID;
    $loggedIn = session()->has('username');
    @endphp
    <div class="row-user-review" id="review-{{$reviewID}}">
        <!-- A container for user profile -->
        <div class="row-container">
            <div class="user-profile">
                <div class="col-user-profile profile-pic">
                    @if (isset($profilePicture))
                    <img src="{{ $profilePicture }}" alt="profile">
                    @else
                    <img src="{{ asset('profile-images/profile.png') }}" alt="profile">
                    @endif
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
                <a href="{{route('review.edit', $review->reviewID)}}"><i class="fas fa-edit"></i><span>Edit</span></a>
                <a href="{{route('review.delete', $review->reviewID)}}"><i class="fas fa-trash"></i><span>Delete</span></a>
            </div>
            <div class="reply" id="reply-{{$replyID}}">
                <form method="post" action="{{route('profile.review.submit.comment')}}">
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
        @foreach($review->comments as $comment)
        @include('include.comment', ['comment' => $comment, 'replyID' => $replyID])
        @endforeach
    </div>
    @empty
    @endforelse
</div>
@endsection