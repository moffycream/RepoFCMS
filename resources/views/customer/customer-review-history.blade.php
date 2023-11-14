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
                <a onclick="toggleReviewEdit('{{$reviewID}}')"><i class="fas fa-edit"></i><span>Edit</span></a>
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


    @if (session()->has('errorID') && session('errorID') == $reviewID)
    <div class="container-review-edit" style="display: block;" id="edit-form-{{$reviewID}}">
    @else
    <div class="container-review-edit" style="display: none;" id="edit-form-{{$reviewID}}">
    @endif
    <div class="review-edit-bg"></div>
    <div class="review-edit">
        <h1>Edit Review</h1>
        <form method="post" action="{{ route('review.edit.submit', $reviewID) }}">
            @csrf
            @php
            $oldCategory_1 = "";
            $oldCategory_2 = "";
            $oldCategory_3 = "";
            $oldCategory_4 = "";
            if ($review->reviewCategory === 'food') {
            $oldCategory_1 = 'selected';
            } else if ($review->reviewCategory  === 'service') {
            $oldCategory_2 = 'selected';
            } else if ($review->reviewCategory  === 'delivery') {
            $oldCategory_3 = 'selected';
            } else if ($review->reviewCategory  === 'others') {
            $oldCategory_4 = 'selected';
            }

            @endphp
            <div class="row">
                <p>Category *</p>
                <select id="category" name="reviewCategory">
                    <option value="" disabled selected>Select a category</option>
                    <option value="food" {{$oldCategory_1}}>Food</option>
                    <option value="service" {{$oldCategory_2}}>Service</option>
                    <option value="delivery" {{$oldCategory_3}}>Delivery</option>
                    <option value="others" {{$oldCategory_4}}>Others</option>
                </select>
                @if ($errors->has('reviewCategory'))
                <span class="error">{{ $errors->first('reviewCategory') }}</span>
                @endif
            </div>

            <div class="row">
                <p>Your overall rating *</p>
                <div class="container-stars">
                    @for ($i = 5; $i >= 1; $i--)
                    @php
                    $oldRating = $review->reviewRating == $i ? 'checked' : '';
                    @endphp
                    <input type="radio" id="{{ $i }}" name="reviewRating" value="{{ $i }}" {{$oldRating}}>
                    <label for="{{ $i }}"><i class="fas fa-star"></i></label>
                    @endfor
                </div>
                @if (session()->has('errorID') && session('errorID') == $reviewID)
                @if ($errors->has('reviewRating'))
                <span class="error">{{ $errors->first('reviewRating') }}</span>
                @endif
                @endif
            </div>

            <div class="row">
                <p>Title of your review *</p>
                <input type="text" id="title" name="reviewTitle" value="{{$review->reviewTitle}}" placeholder="Title of your review">
                @if (session()->has('errorID') && session('errorID') == $reviewID)
                @if ($errors->has('reviewTitle'))
                <span class="error">{{ $errors->first('reviewTitle') }}</span>
                @endif
                @endif
            </div>

            <div class="row">
                <p>Your review *</p>
                <textarea id="review" name="reviewContent" placeholder="Your review" >{{$review->reviewContent}}</textarea>
                @if (session()->has('errorID') && session('errorID') == $reviewID)
                @if ($errors->has('reviewContent'))
                <span class="error">{{ $errors->first('reviewContent') }}</span>
                @endif
                @endif
            </div>

            <div class="row-action">
                <a onclick="toggleReviewEdit('{{$reviewID}}')">Cancel</a>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
    </div>
    
    @empty
    @endforelse
</div>
@endsection