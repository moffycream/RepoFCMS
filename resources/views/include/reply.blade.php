@php
$username = $reply->user->username;
$time = $reply->getTimeDifference();
$content = $reply->commentContent;
$replyID = $reply->commentID;
$nestingLevel = $reply->getNestingLevel();
@endphp
<div class="row-container-comment reply comment-reply" data-nesting-level="{{$nestingLevel}}" id="comment-{{$replyID}}">
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
                @if ($reply->user->username == session('username'))
                <a href="{{route('review.comment.edit', $replyID)}}"><i class="fas fa-edit"></i><span>Edit</span></a>
                <a href="{{route('review.comment.delete', $reviewID)}}"><i class="fas fa-trash"></i><span>Delete</span></a>
                @endif
            </div>
            <div class="reply" id="reply-{{$replyID}}">
                <form method="post" action="{{route('profile.review.submit.comment')}}">
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

    @foreach($reply->replies as $reply)
    @include('include.reply' , ['reply' => $reply])
    @endforeach
</div>