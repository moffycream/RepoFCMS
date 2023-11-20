<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserAccountController;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ValidationController;

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

    // view feedback page as admin
    public function adminViewFeedback(AdminController $userAccountController)
    {
        // Checks whether is admin session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyAdmin()) {
            // retrive all feedbacks from database when viewing as admin
            return view('admin/admin-view-feedback', ['feedbacks' => Feedback::all()], ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    // filter feedbacks as admin
    public function adminFilterFeedback(Request $request, AdminController $userAccountController)
    {
        // Checks whether is admin session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyAdmin()) {
            // retrive all feedbacks from database when viewing as admin
            if ($request->filter == "feedbackID") {
                return view('admin/admin-view-feedback', ['feedbacks' => Feedback::orderBy('feedbackID', $request->order)->get()], ['notifications' => Notification::all()]);
            } else if ($request->filter == "rating") {
                return view('admin/admin-view-feedback', ['feedbacks' => Feedback::orderBy('rating', $request->order)->get()], ['notifications' => Notification::all()]);
            } else {
                return view('admin/admin-view-feedback', ['feedbacks' => Feedback::where('typeOfFeedback', $request->filter)->orderBy('feedbackID', $request->order)->get()], ['notifications' => Notification::all()]);
            }
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
        $validator = app(ValidationController::class);

        $newFeedback->firstName = $request->firstname;
        $newFeedback->lastName = $request->lastname;

        // validate email
        if ($validator->validateEmail($request)) {
            $newFeedback->email = $request->email;
            $emailErrorMsg = "";
        } else {
            $emailErrorMsg = "Invalid email address";
        }

        // validate phone
        if ($validator->validatePhone($request)) {
            $newFeedback->phone = $request->phone;
            $phoneErrorMsg = "";
        } else {
            $phoneErrorMsg = "Invalid phone number<br>(max 10 numbers)";
        }

        $newFeedback->rating = $request->rating;

        // validate type of feedback
        if ($validator->validateTypeOfFeedback($request)) {
            $newFeedback->typeOfFeedback = $request->typeoffeedback;
            $typeOfFeedbackErrorMsg = "";
        } else {

            $typeOfFeedbackErrorMsg = "Please choose a type of feedback";
        }
        $newFeedback->comments = $request->comments;

        if ($emailErrorMsg == "" && $phoneErrorMsg == "" && $typeOfFeedbackErrorMsg == "") {
            // save the feedback if no error
            $newFeedback->save();

            // reset the form
            $request->replace([]);

            return view('customer/feedback-successful', ['notifications' => Notification::all()]);
        } else {
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
