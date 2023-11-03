<?php

namespace App\Http\Controllers;

use App\Models\UserAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ValidationController;

class ProfileController extends Controller
{
    public function index()
    {
        $notificationController = app(NotificationController::class);
        $username = Session::get('username');
        if (!$username) {
            // Redirect the user to the login page if not logged in
            return redirect('/login')->with('error', 'You are not logged in.');
        }
        $user = UserAccounts::where('username', $username)->first();
        if (!$user) {
            // Redirect to login if the user doesn't exist in the database
            return redirect('/register')->with('error', 'User not found.');
        }
        return view('customer.profile', ['user' => $user,  'notifications' => $notificationController->getNotification()]);
    }


    public function editProfile(Request $request)
    {
        $validator = app(ValidationController::class);

        $usernameErrorMsg = "";
        $phoneErrormsg = "";
        $emailErrormsg = "";
        $postcodeErrormsg = "";


        $notificationController = app(NotificationController::class);
        $user = UserAccounts::find($request->userID);
        if ($user) {
            if ($request->has('username')) {
                // Check if the new username is the same as the original username
                if ($request->username !== $user->username) {
                    // If it's not the same, validate if the username is unique
                    if (!($validator->validateSameUsername($request))) {
                        $usernameErrorMsg = $request->username . " Username already exists.";
                    } else {
                        $usernameErrorMsg = "";
                        $user->username = $request->username;
                    }
                } else {
                    // Username is the same, no further validation needed
                    $usernameErrorMsg = "";
                    $user->username = $request->username;
                }
            }
            
            if ($request->has('phone')) {
                if ($validator->validatePhone($request)) {
                    $user->phone = $request->phone;
                } else {
                    $phoneErrormsg = $request->phone . " is an Invalid Phone Number";
                }
            }
            if ($request->has('first')) {
                $user->firstName = $request->first;
            }
            if ($request->has('last')) {
                $user->lastName = $request->last;
            }
            if ($request->has('email')) {
                if ($validator->validateEmail($request)) {
                    $user->email = $request->email;
                } else {
                    $emailErrormsg = $request->email . " is an Invalid Email";
                }
            }
            if ($request->has('streetAddress')) {
                $user->streetAddress = $request->streetAddress;
            }
            if ($request->has('city')) {
                $user->city = $request->city;
            }
            if ($request->has('postcode')) {
                if ($validator->validatePostcode($request)) {
                    $user->postcode = $request->postcode;
                } else {
                    $postcodeErrormsg = $request->postcode . " is an Invalid Postcode";
                }
            }

            if ($request->hasFile('image')) {

                $fileName = time() . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('', $fileName, 'addProfile');
                $user->imagePath = 'profile-images/' . $path;
            }

            if ($usernameErrorMsg== "" && $phoneErrormsg == "" && $emailErrormsg == "" && $postcodeErrormsg == "") {
                $user->save();
                return view('customer.profile', ['user' => $user,  'notifications' => $notificationController->getNotification()]);
            } else {
                return view('customer.profile', ['user' => $user, 'notifications' => $notificationController->getNotification()])
                    ->with('usernameErrorMsg', $usernameErrorMsg)
                    ->with('phoneErrormsg', $phoneErrormsg)
                    ->with('emailErrormsg', $emailErrormsg)
                    ->with('postcodeErrormsg', $postcodeErrormsg);
            }
        }
    }
}
