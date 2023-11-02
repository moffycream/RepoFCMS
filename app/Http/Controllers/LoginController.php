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
        $validator = app(ValidationController::class);
        $notificationController = app(NotificationController::class);

        // if validate passes, then redirect to webpage based on account type
        if ($validator->validateLogin($request)) {
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

            Session::flash('error', 'Failed login. Please check your username and password.');
            return view('login.login')->with(['notifications' => $notificationController->getNotification()]);
        }
    }

    public function forgotPassword()
    {
        $notificationController = app(NotificationController::class);
        return view('login.forgot-password')->with(['notifications' => $notificationController->getNotification()]);
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

    public function endSession()
    {
        Session::forget('username');
        Session::forget('accountType');
        session()->flush();

        return redirect('/login');
    }
}
