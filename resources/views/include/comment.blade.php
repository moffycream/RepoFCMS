@php
$username = $comment->user->username;
$time = $comment->getTimeDifference();
$content = $comment->commentContent;
$commentID = $comment->commentID;
$nestingLevel = $comment->getNestingLevel();
$replyID = $commentID;
@endphp
<div class="row-container-comment comment" data-nesting-level="{{$nestingLevel}}" id="comment-{{$commentID}}">
    <div class="comment-container">
        <div class="user-profile">
            <div class="col-user-profile profile-pic">
                @php
                $profilePicture = $comment->profilePicture();
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
                <button type="button" onclick="toggleRepliedComments('{{$commentID}}')"><i class="fas fa-comment-alt"></i><span>Comment</span> <span>({{$comment->getTotalComments()}})</span></button>
                <button type="button" onclick="toggleReply('{{$replyID}}')"><i class="fas fa-reply"></i><span>Reply</span></button>
                <!-- Only the review history page can activate this -->

                @if ($comment->user->username == session('username') && isset($reviewHistory)) 
                <a href="{{route('review.comment.edit', $commentID)}}"><i class="fas fa-edit"></i><span>Edit</span></a>
                <a href="{{route('review.comment.delete', $commentID)}}"><i class="fas fa-trash"></i><span>Delete</span></a>
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
                    <input type="hidden" name="reviewID" value="{{$comment->reviewID}}">
                    <input type="hidden" name="replyToCommentID" value="{{$comment->commentID}}">
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
    @foreach($comment->replies as $reply)
    @include('include.reply' , ['reply' => $reply, 'replyID' => $replyID])
    @endforeach
</div>