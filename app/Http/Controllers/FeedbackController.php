<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UserAccountController;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // used for verification
    protected $userAccountController;

    // Feedback page linkage
    public function index(UserAccountController $userAccountController)
    {
        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer/feedback', ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function submitFeedback(Request $request)
    {
        $emailErrorMsg = "";
        $phoneErrorMsg = "";
        $typeOfFeedbackErrorMsg = "";
        $newFeedback = new Feedback();
        $newFeedback->firstName = $request->firstname;
        $newFeedback->lastName = $request->lastname;

        // validate email
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $newFeedback->email = $request->email;
            $emailErrorMsg = "";
        }
        else {
            $emailErrorMsg = "Invalid email address";
        }
        
        // validate phone
        $phonePattern = '/^\d{10}$/';
        if (preg_match($phonePattern, $request->phone)) {
            $newFeedback->phone = $request->phone;
            $phoneErrorMsg = "";
        }
        else {
            $phoneErrorMsg = "Invalid phone number<br>(max 10 numbers)";
        }

        $newFeedback->rating = $request->rating;

        // validate type of feedback
        if ($request->typeoffeedback == "none") {
            $typeOfFeedbackErrorMsg = "Please choose a type of feedback";
        }
        else {
            $newFeedback->typeOfFeedback = $request->typeoffeedback;
            $typeOfFeedbackErrorMsg = "";
        }
        $newFeedback->comments = $request->comments;

        if ($emailErrorMsg == "" && $phoneErrorMsg == "" && $typeOfFeedbackErrorMsg == "")
        {
            // save the feedback if no error
            $newFeedback->save();

            // reset the form
            $request->replace([]);
            
            return view('customer/feedback-successful', ['notifications' => Notification::all()]);
        }
        else {
            return view('customer/feedback', ['notifications' => Notification::all(), 'emailErrorMsg' => $emailErrorMsg, 'phoneErrorMsg' => $phoneErrorMsg, 'typeOfFeedbackErrorMsg' => $typeOfFeedbackErrorMsg]);
        }
    }

    // return view for feedback success
    public function feedbackSuccess(UserAccountController $userAccountController)
    {
        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer/feedback-successful', ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }
}
