<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'reviewID';
    protected $fillable = [
        'userID',
        'reviewTitle',
        'reviewContent',
        'reviewRating',
        'reviewCategory',
    ];

    public function user()
    {
        return $this->belongsTo(UserAccounts::class, 'userID');
    }

    public function comments()
    {
        // Get the comments for the review that are not replies
        return $this->hasMany(Comment::class, 'reviewID')->whereNull('replyToCommentID');
    }

    // Menu relationship
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menuID');
    }

    // Get time difference between now and the time the review was created
    public function getTimeDifference()
    {
        // Calculate the time difference in the format of weeks, days, hours, minutes, and seconds
        // If over the 60 seconds it will show a few minutes ago
        // If over the 60 minutes it will show a few hours ago
        // If over the 24 hours it will show a day ago
        // If over the 7 days it will show a week ago
        // If over the 4 weeks it will show a month ago
        
        $timeDifference = $this->created_at->diffForHumans();
        return $timeDifference;
    }

    // Get the total number of comments for a review
    public function getTotalComments()
    {
        // Get the total number of comments for a review, including replies
        $totalComments = Comment::where('reviewID', $this->reviewID)->count();
        return $totalComments;
    }
}
