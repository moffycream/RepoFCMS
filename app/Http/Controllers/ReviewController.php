<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\UserAccounts;
use App\Models\Comment;
use Illuminate\Contracts\Session\Session;
use App\Models\Notification;

class ReviewController extends Controller
{
    public function index()
    {
        // Get all the reviews with their comments and replies
        $reviews = Review::with('comments.replies')->get();

        return view('reviews', ['reviews' => $reviews]);
    }


    public function customerReviewHistory()
    {
        // Get all the reviews with their comments and replies that belong to the user
        if (session()->has('username')) {
            $userAccount = UserAccounts::where('username', session('username'))->first();
            if ($userAccount != null) {
                $reviews = Review::with('comments.replies')->where('userID', $userAccount->userID)->get();
            }
        }

        return view('customer.customer-review-history', ['reviews' => $reviews]);
    }

    public function reviewEdit($reviewID)
    {
        return view('review-edit', ['reviewID' => $reviewID]);
    }

    public function commentEdit($commentID)
    {
        return view('review-comment-edit', ['commentID' => $commentID]);
    }

    public function saveReviewEdit(Request $request)
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
                // Get the review
                $review = Review::where('reviewID', $request->reviewID)->first();
                if ($review != null) {
                    // Update the review
                    $review->reviewTitle = $validatedData['reviewTitle'];
                    $review->reviewContent = $validatedData['reviewContent'];
                    $review->reviewRating = $validatedData['reviewRating'];
                    $review->reviewCategory = $validatedData['reviewCategory'];
                    $review->save();
                    // Return back to reviews page
                    return redirect('/customer-review-history')->with('success', 'Review updated successfully!');
                }
            }
        }
        return redirect('/customer-review-history/{reviewID}')->withErrors($validatedData);
    }

    public function saveCommentEdit(Request $request)
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
                // Get the comment
                $comment = Comment::where('commentID', $request->commentID)->first();
                if ($comment != null) {
                    // Update the comment
                    $comment->commentContent = $validatedData['commentContent'];
                    $comment->save();
                    // Return back to reviews page
                    return redirect('/customer-review-history')->with('success', 'Comment updated successfully!');
                }
            }
        }
        return redirect('/customer-review-history/{commentID}')->withErrors($validatedData);
    }

    public function reviewDelete($reviewID)
    {
        // Get user id
        if (session()->has('username')) {
            $userAccount = UserAccounts::where('username', session('username'))->first();
            if ($userAccount != null) {
                // Get the review
                $review = Review::where('reviewID', $reviewID)->first();
                if ($review != null) {
                    // Delete the review
                    $review->delete();
                    // Return back to reviews page
                    return redirect('/customer-review-history')->with('success', 'Review deleted successfully!');
                }
            }
        }
        return redirect('/customer-review-history');
    }

    public function commentDelete($commentID)
    {
        // Get user id
        if (session()->has('username')) {
            $userAccount = UserAccounts::where('username', session('username'))->first();
            if ($userAccount != null) {
                // Get the comment
                $comment = Comment::where('commentID', $commentID)->first();

                // Delete the replies too
                $replies = Comment::where('replyToCommentID', $commentID)->get();
                foreach ($replies as $reply) {
                    $reply->delete();
                }

                if ($comment != null) {
                    // Delete the comment
                    $comment->delete();
                    // Return back to reviews page
                    return redirect('/customer-review-history')->with('success', 'Comment deleted successfully!');
                }
            }
        }
        return redirect('/customer-review-history');
    }

    public function reviewForm()
    {
        if (session()->has('username')) {
            return view('review-form');
        } else {
            // Return errors
            return redirect('/login');
        }
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
                // Return back to reviews page
                return redirect('/reviews')->with('success', 'Review submitted successfully!');
            }
        }
        return redirect('/reviews')->withErrors($validatedData);
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
                        // Send notification
                $this->sendNotification($request->reviewID);
                // Return back to reviews page
                return redirect('/reviews')->with('success', 'Comment submitted successfully!');
            }
        }
    }

    // Send notification
    public function sendNotification($reviewID)
    {
        // Get the review
        $review = Review::where('reviewID', $reviewID)->first();
        if ($review != null) {
            // Get the user who made the review
            $userAccount = UserAccounts::where('userID', $review->userID)->first();
            if ($userAccount != null) {
                // Get the user who is logged in
                if (session()->has('username')) {
                    $loggedInUserAccount = UserAccounts::where('username', session('username'))->first();
                    if ($loggedInUserAccount != null) {
                        // Create a new notification instance
                        $notification = new Notification();
                        $notification->userID = $userAccount->userID;
                        $notification->content = $loggedInUserAccount->username . ' commented on your review.';
                        $notification->save();
                    }
                }
            }
        }
    }

    public function profileSubmitComment(Request $request)
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
                // Send notification
                $this->sendNotification($request->reviewID);
                // Return back to reviews page
                return redirect('/customer-review-history')->with('success', 'Comment submitted successfully!');
            }
        }
    }
}
