@php
$username = $reply->user->username;
$time = $reply->getTimeDifference();
$content = $reply->commentContent;
$replyID = $reply->commentID;
$nestingLevel = $reply->getNestingLevel();
@endphp
@if (session()->has('errorCommentID'))
<div class="row-container-comment reply comment-reply" data-nesting-level="{{$nestingLevel}}" id="comment-{{$replyID}}" style="display: block;">
@else
<div class="row-container-comment reply comment-reply" data-nesting-level="{{$nestingLevel}}" id="comment-{{$replyID}}" style="display: none;">
@endif
    <div class="comment-container">
        <div class="user-profile">
            <div class="col-user-profile profile-pic">
                @php
                $profilePicture = $reply->profilePicture();
                @endphp
                <img src="{{ asset($profilePicture)}}" alt="user-profile">
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
                <button type="button" onclick="toggleRepliedComments('{{$replyID}}')"><i class="fas fa-comment-alt"></i><span>Comment</span> <span>({{$reply->getTotalComments()}})</span></button>
                <button type="button" onclick="toggleReply('{{$replyID}}')"><i class="fas fa-reply"></i><span>Reply</span></button>
                @if ($reply->user->username == session('username') && isset($reviewHistory))
                <a onclick="toggleReviewCommentEdit('{{$replyID}}')"><i class="fas fa-edit"></i><span>Edit</span></a>
                <a href="{{route('review.comment.delete', $reviewID)}}"><i class="fas fa-trash"></i><span>Delete</span></a>
                @endif
            </div>
            <div class="reply" id="reply-{{$replyID}}">
                @php
                if (session('accountType') == 'Admin' || (session('accountType') == 'DefaultAdmin')) {
                $reviewRedirect = route('admin.review.submit.comment');
                }
                else
                {
                $reviewRedirect = route('review.submit.comment');
                if (isset($reviewHistory)) {
                $reviewRedirect = route('profile.review.submit.comment');
                }
                }
                @endphp
                <form method="post" action="{{$reviewRedirect}}">
                    @csrf
                    <input type="hidden" name="reviewID" value="{{$reply->reviewID}}">
                    <input type="hidden" name="replyToCommentID" value="{{$reply->commentID}}">
                    <input type="text" name="commentContent" placeholder="Write a comment" value="">
                    @if ($loggedIn)
                    <button type="submit">Send</button>
                    @else
                    <a href="{{url('login')}}" class="login">Login</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @if (session()->has('errorCommentID') && session('errorCommentID') == $replyID)
    <div class="container-review-edit" style="display: block;" id="edit-comment-form-{{$replyID}}">
    @else
    <div class="container-review-edit" style="display: none;" id="edit-comment-form-{{$replyID}}">
    @endif
    <div class="review-edit-bg"></div>
    <div class="review-edit">
        <h1>Edit Comment</h1>
        <form method="post" action="{{ route('review.comment.edit.submit', $replyID) }}">
            @csrf

            <div class="row">
                <p>Your comment *</p>
                <textarea id="review" name="commentContent" placeholder="Your comment" >{{$reply->commentContent}}</textarea>
                @if (session()->has('errorCommentID') && session('errorCommentID') == $replyID)
                @if ($errors->has('commentContent'))
                <span class="error">{{ $errors->first('commentContent') }}</span>
                @endif
                @endif
            </div>

            <div class="row-action">
                <a onclick="toggleReviewCommentEdit('{{$replyID}}')">Cancel</a>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
    </div>
    @foreach($reply->replies as $reply)
    @include('include.reply' , ['reply' => $reply])
    @endforeach
</div>