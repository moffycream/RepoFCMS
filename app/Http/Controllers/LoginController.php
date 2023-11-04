<?php

namespace App\Http\Controllers;

use App\Models\UserAccounts;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // login function
    public function index(Request $request)
    {
        $loginController = app(LoginController::class);
        $validator = app(ValidationController::class);
        $notificationController = app(NotificationController::class);
        // if validate passes, then redirect to webpage based on account type
        if ($validator->validateLoginCredentials($request)) {

            $user = UserAccounts::where('username', $request->username)->first();

            // if user is either first time login or has is not authenticated
            if($user->twoFactorAuth == 1 || $user->isAuthenticated == 0 || $user->firstTimeLogin == 1) {
                $loginController->start2FA();

                Session::put('username', $user->username); // Store 'username' in a session variable
                $request->replace([]); // clear the request

                return redirect('/two-factor-authentication');
            } else {
                Session::put('username', $user->username); // Store 'username' in a session variable
                Session::put('accountType', $user->accountType); // Store 'accountType' in a session variable
                if (Session::get('accountType') == "DefaultAdmin" || Session::get('accountType') == "Admin") {
                    return redirect('/admin-dashboard');
                } else if (Session::get('accountType') == "OperationTeam") {
                    // $orderController = app(OrderController::class);
                    // $result = $orderController->index();
                    return redirect('op-orders');
                } else if (Session::get('accountType') == "Customer") {
                    return redirect('/');
                }
            }
        } else {

            Session::flash('error', 'Failed login. Please check your username and password.');
            return view('login.login')->with(['notifications' => $notificationController->getNotification()]);
        }
    }

    public function forgotPassword()
    {
        $notificationController = app(NotificationController::class);
        return view('login.forgot-password')->with(['notifications' => $notificationController->getNotification()]);
    }

    public function twoFactorAuthentication()
    {
        return view('login.two-factor-authentication');
    }

    public function resetPassword(Request $request)
    {
        $username = $request->username;
        $newpassword = $request->newpassword;
        $confirmnewpassword = $request->confirmnewpassword;

        $user = UserAccounts::where('username', $username)->first();

        if ($user && ($newpassword == $confirmnewpassword)) {
            if ($username != "FCMS") {
                if (strlen($newpassword) < 5) {
                    Session::flash('forgotpassworderror', 'New password needs to be more than 5 characters in length');
                    return view('login.forgot-password');
                } else {
                    $user->password = Hash::make($newpassword);
                    $user->save();
                    Session::flash('success', 'Password updated, you may login with your new password now');
                    return view('login.login');
                }
            } else {
                Session::flash('forgotpassworderror', 'Default admin unable to reset password.');
                return view('login.forgot-password');
            }
        } else {
            Session::flash('forgotpassworderror', 'Failed to reset password. Please check your username and new password.');
            return view('login.forgot-password');
        }
    }

    public function start2FA()
    {
        // generate a random 6 digit number
        $code = rand(100000, 999999);

        // store the code in session
        Session::put('2FACode', $code);

        // start recording time for 2FA
        Session::put('2FATime', time());

        // set end time for 2FA (after 10 minutes)
        Session::put('2FAEndTime', time() + 600);
    }

    public function verify2FA(Request $request)
    {
        // checks if the code entered by user is the same as the code in session
        if ($request->code == Session::get('2FACode')) {
            // checks if the time elapsed is less than 10 minutes
            if (time() < Session::get('2FAEndTime')) {
                // get the user's email from session
                $username = Session::get('username');

                // get the user's account from database
                $user = UserAccounts::where('username', $username)->first();

                // set the user's authentication to true
                $user->isAuthenticated = 1;

                // set the user's first time login to false
                $user->firstTimeLogin = 0;

                // save the changes to the database
                $user->save();

                // remove the 2FA code from session
                Session::forget('2FACode');
                Session::forget('2FATime');
                Session::forget('2FAEndTime');

                // login
                Session::put('accountType',$user->accountType); // Store 'accountType' in a session variable
                
                if (Session::get('accountType') == "DefaultAdmin" || Session::get('accountType') == "Admin") {
                    return redirect('/admin-dashboard');
                } else if (Session::get('accountType') == "OperationTeam") {
                    // $orderController = app(OrderController::class);
                    // $result = $orderController->index();
                    return redirect('op-orders');
                } else if (Session::get('accountType') == "Customer") {
                    return redirect('/');
                }
            } else {
                // if the time elapsed is more than 10 minutes, redirect user to login page
                return redirect('/login');
            }
        } else {
            // if the code entered by user is not the same as the code in session, redirect user to login page
            return redirect('/login');
        }
    }

    public function endSession()
    {
        // get the user's username from session
        $username = Session::get('username');

        // get the user's account from database
        $user = UserAccounts::where('username', $username)->first();

        // if user got toggle on this feature, set the user's authentication to false (so next time login, will prompt for 2FA)
        if ($user->twoFactorAuth == 1)
        {
            $user->isAuthenticated = 0;
            $user->save();
        }

        Session::forget('username');
        Session::forget('accountType');
        session()->flush();

        return redirect('/login');
    }
}
