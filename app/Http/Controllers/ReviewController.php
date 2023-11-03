<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\UserAccounts;
use App\Models\Comment;

class ReviewController extends Controller
{
    public function index()
    {
        $notificationController = app(NotificationController::class);
        // Get all the reviews
        $reviews = Review::all();
        return view('reviews', ['reviews' => $reviews,'notifications' => $notificationController->getNotification()]);
    }

    public function reviewForm()
    {
        return view('review-form');
    }

    // Save the review to the database
    public function submitReviewForm()
    {
        // Custom error message
        $message = [
            'reviewTitle.required' => 'Please provide a title for your review.',
            'reviewContent.required' => 'Please write your review.',
            'reviewRating.required' => 'Please select a rating.',
            'reviewRating.numeric' => 'Rating should be a numeric value.',
            'reviewRating.min' => 'Rating must be at least 1.',
            'reviewRating.max' => 'Rating must not exceed 5.',
            'reviewCategory.required' => 'Please select a category.',
        ];

        // Validate the user's input
        $validatedData = request()->validate([
            'reviewTitle' => 'required|max:255',
            'reviewContent' => 'required|max:255',
            'reviewRating' => 'required|numeric|min:1|max:5',
            'reviewCategory' => 'required|max:255',
        ], $message);

        // Get user id
        if (session()->has('username')) {
            $userAccount = UserAccounts::where('username', session('username'))->first();
            if ($userAccount != null) {
                // Create a new review instance
                $review = new Review();
                $review->userID = $userAccount->userID;
                $review->reviewTitle = $validatedData['reviewTitle'];
                $review->reviewContent = $validatedData['reviewContent'];
                $review->reviewRating = $validatedData['reviewRating'];
                $review->reviewCategory = $validatedData['reviewCategory'];
                $review->save();
            }
        }

        // Return back to reviews page
        return redirect('/reviews')->with('success','Review submitted successfully!');
    }

    // Make a comment
    public function submitComment(Request $request)
    {
        // Custom error message
        $message = [
            'commentContent.required' => 'Please write your comment.',
        ];
        $validatedData = request()->validate([
            'commentContent' => 'required|max:255',
        ], $message);

        // Get user id
        if (session()->has('username')) {
            $userAccount = UserAccounts::where('username', session('username'))->first();
            if ($userAccount != null) {
                // Create a new comment instance
                $comment = new Comment();
                $comment->reviewID = $request->reviewID;
                if ($request->replyToCommentID != null) {
                    $comment->replyToCommentID = $request->replyToCommentID;
                }
                $comment->userID = $userAccount->userID;
                $comment->commentContent = $validatedData['commentContent'];
                $comment->save();
            }
        }

        // Return back to reviews page
        return redirect('/reviews')->with('success','Comment submitted successfully!');
    }
}
