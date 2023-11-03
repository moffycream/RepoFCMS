<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'commentID';
    protected $fillable = [
        'reviewID',
        'userID',
        'commentContent',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class, 'reviewID');
    }

    public function user()
    {
        return $this->belongsTo(UserAccounts::class, 'userID');
    }

    // Get the time difference between the current time and the time the review was posted
    public function getTimeDifference()
    {
        $time = strtotime($this->created_at);
        $currentTime = time();
        $timeDifference = $currentTime - $time;
        $seconds = $timeDifference;
        $minutes = round($seconds / 60);
        $hours = round($seconds / 3600);
        $days = round($seconds / 86400);
        $weeks = round($seconds / 604800);
        $months = round($seconds / 2629440);
        $years = round($seconds / 31553280);

        if ($seconds <= 60) {
            return "Just now";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 minute ago";
            } else {
                return "$minutes minutes ago";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "1 hour ago";
            } else {
                return "$hours hours ago";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return "1 day ago";
            } else {
                return "$days days ago";
            }
        } else if ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "1 week ago";
            } else {
                return "$weeks weeks ago";
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return "1 month ago";
            } else {
                return "$months months ago";
            }
        } else {
            if ($years == 1) {
                return "1 year ago";
            } else {
                return "$years years ago";
            }
        }
    }

    // Get the total number of comments for this comment
    public function getTotalComments()
    {
        $totalComments = Comment::where('replyToCommentID', $this->commentID)->count();
        return $totalComments;
    }

    // Get the nesting level of this comment
    public function getNestingLevel()
    {
        $nestingLevel = 1;
        $comment = $this;
        while ($comment->replyToCommentID != null) {
            $nestingLevel++;
            $comment = Comment::where('commentID', $comment->replyToCommentID)->first();
        }
        return $nestingLevel;
    }
}
