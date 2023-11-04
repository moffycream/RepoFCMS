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
            @if ($reviews->count() > 0)
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
        $replyID++
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
            <div class="row-container no-pad">
                <div class="review-content">
                    <h2>{{$title}}</h2>
                    <p>{{$content}}</p>
                </div>
            </div>
            <div class="row-container no-pad">
                <div class="review-action">
                    <button type="button" onclick="toggleComments()"><i class="fas fa-comment-alt"></i><span>Comment</span> <span>({{$review->getTotalComments()}})</span></button>
                    <button type="button" onclick="toggleReply('{{$replyID}}')"><i class="fas fa-reply"></i><span>Reply</span></button>
                </div>
                <div class="reply" id="{{$replyID}}">
                    <form method="post" action="{{route('review.submit.comment')}}">
                        @csrf
                        <input type="hidden" name="reviewID" value="{{$review->reviewID}}">
                        <input type="text" name="commentContent" placeholder="Write a comment" value="">
                        <button type="submit">Send</button>
                    </form>
                </div>
            </div>
            <!-- Comment Session -->
            @foreach($review->comments as $comment)
            @php
            $username = $comment->user->username;
            $time = $comment->getTimeDifference();
            $content = $comment->commentContent;

            $nestingLevel = $comment->getNestingLevel();
            $replyID++
            @endphp
            <div class="row-container-comment comment" data-nesting-level="{{$nestingLevel}}">
                <div class="comment-container">
                    <div class="user-profile">
                        <div class="col-user-profile profile-pic">
                            <img src="https://i.imgur.com/6VBx3io.png" alt="user-profile">
                        </div>
                        <div class="col-user-profile">
                            <h3 class="row-user-profile">{{$username}}<span><span class="review-time">{{$time}}</span></span></h3>
                        </div>
                    </div>
                    <div class="row-comment">
                        <div class="comment-content">
                            <p>{{$content}}</p>
                        </div>
                    </div>
                    <div class="row-comment">
                        <div class="comment-action">
                            <button type="button" onclick="toggleComments()"><i class="fas fa-comment-alt"></i><span>Comment</span> <span>({{$comment->getTotalComments()}})</span></button>
                            <button type="button" onclick="toggleReply('{{$replyID}}')"><i class="fas fa-reply"></i><span>Reply</span></button>
                        </div>
                        <div class="reply" id="{{$replyID}}">
                            <form method="post" action="{{route('review.submit.comment')}}">
                                @csrf
                                <input type="hidden" name="reviewID" value="{{$comment->reviewID}}">
                                <input type="hidden" name="replyToCommentID" value="{{$comment->commentID}}">
                                <input type="text" name="commentContent" placeholder="Write a comment" value="">
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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