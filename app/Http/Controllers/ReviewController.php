<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\UserAccounts;

class ReviewController extends Controller
{
    public function index()
    {
        // Get all the reviews
        $reviews = Review::all();
        return view('reviews', ['reviews' => $reviews]);
    }

    public function reviewForm()
    {
        return view('review-form');
    }

    // Save the review to the database
    public function submitReviewForm(Request $request)
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
            $userID = UserAccounts::where('username', session('username'))->first()->userID;
            if ($userID != null) {
                // Create a new review instance
                $review = new Review();
                $review->userID = $userID;
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

}
