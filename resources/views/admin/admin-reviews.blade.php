@extends('layouts.admin')
@section('title', 'Reviews Analytics')
@section('content')

@php
$replyID = 0;
@endphp

<div class="container-admin-reviews">
    <div class="row-first">
        <h1>Reviews</h1>
    </div>

    <div class="row-overall">
        @php
        if (!isset($totalReviews)) {
        $totalReviews = 0;
        }

        if (!isset($averageRating)) {
        $averageRating = 0;
        }
        @endphp
        <div>
            <p>Total Reviews</p>
            <h2>{{$totalReviews}}</h2>
        </div>
        <div>
            <p>Average Rating</p>
            <h2>{{$averageRating}}</h2>
        </div>
        <div>
            <p>All ratings</p>
            @php
            $ratings = array(0, 0, 0, 0, 0);
            foreach ($reviews as $review) {
            $ratings[$review->reviewRating - 1]++;
            }
            @endphp
            <div class="container-stars">
                @for($i = 0; $i < 5; $i++) 
                <div class="row-stars">
                    <div class="col-stars">
                        @for ($j = 0; $j < 5; $j++)
                        @if ($j < $i + 1)
                            <i class="fas fa-star"></i>
                            @else
                            <i class="far fa-star"></i>
                            @endif
                         @endfor
                    </div>
                    <div class="col-stars">
                        <h2>{{$ratings[$i]}}</h2>
                    </div>
                </div>
                    @endfor
            </div>
        </div>
    </div>

    <div class="panel">
    <div class="filter">
        @php
        $oldCategory_1 = '';
        $oldCategory_2 = '';
        $oldCategory_3 = '';
        $oldCategory_4 = '';
        $oldCategory_5 = '';

        $oldOrder_1 = '';
        $oldOrder_2 = '';

        if (isset($_POST['category'])) {
        if ($_POST['category'] == 'all') {
        $oldCategory_1 = 'selected';
        } elseif ($_POST['category'] == 'food') {
        $oldCategory_2 = 'selected';
        } elseif ($_POST['category'] == 'service') {
        $oldCategory_3 = 'selected';
        } elseif ($_POST['category'] == 'delivery') {
        $oldCategory_4 = 'selected';
        } elseif ($_POST['category'] == 'others') {
        $oldCategory_5 = 'selected';
        }
        }

        if (isset($_POST['order'])) {
        if ($_POST['order'] == 'ascending') {
        $oldOrder_1 = 'selected';
        } elseif ($_POST['order'] == 'descending') {
        $oldOrder_2 = 'selected';
        }
        }
        @endphp
        <form method="post" action="{{route('admin.reviews.filter')}}">
            @csrf
            <div>
                <select name="category">
                    <option value="all" {{$oldCategory_1}}>All</option>
                    <option value="food" {{$oldCategory_2}}>food</option>
                    <option value="service" {{$oldCategory_3}}>Service</option>
                    <option value="delivery" {{$oldCategory_4}}>Delivery</option>
                    <option value="others" {{$oldCategory_5}}>Others</option>
                </select>
                <select name="order">
                    <option value="ascending" {{$oldOrder_1}}>Ascending</option>
                    <option value="descending" {{$oldOrder_2}}>Descending</option>
                </select>
            </div>
            <button type="submit">Filter</button>
        </form>
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
                    <form method="post" action="{{route('admin.review.submit.comment')}}">
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
            <p>No reviews available</p>
        </div>
        @endforelse
    </div>
</div>

@endsection