<?php

namespace App\Http\Controllers;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;

class LoginController extends Controller
{
    // login function
    public function index(Request $request){
        session_start();

        // Validate the login credentials (You should connect to a database for this)
        $username = $request->username;
        $password = $request->password;

        $user = UserAccounts::where('username', $username)->first();
 
        if ($user && Hash::check($password, $user->password)) {
            // Authentication successful
            Session::put('username', $user->username); // Store the username in the session
            Session::put('accountType', $user->accountType); // Store 'accountType' in a session variable

            if (Session::get('accountType') == "DefaultAdmin" || Session::get('accountType') == "Admin")
            {
                return redirect('/admin-dashboard');
            }
            else if(Session::get('accountType') == "OperationTeam")
            {
                $orderController = app(OrderController::class);
                $result = $orderController->index();
                return $result;
            } 
            else if (Session::get('accountType') == "Customer") 
            {
                return redirect('/');
            }
        } 
        else {
            Session::flash('error', 'Failed login. Please check your username and password.');
            return view('login.login');
        }
    }

    public function forgotPassword()
    {
        return view('login.forgot-password');
    }

    public function resetPassword(Request $request)
    {
        $username = $request->username;
        $newpassword = $request->newpassword;
        $confirmnewpassword = $request->confirmnewpassword;

        $user = UserAccounts::where('username', $username)->first();

        if ($user && ($newpassword == $confirmnewpassword))
        {
            if ($username != "FCMS")
            {
                if (strlen($newpassword) < 5)
                {
                    Session::flash('forgotpassworderror', 'New password needs to be more than 5 characters in length');
                    return view('login.forgot-password');
                }
                else
                {
                    $user->password = Hash::make($newpassword);
                    $user->save();
                    Session::flash('success', 'Password updated, you may login with your new password now');
                    return view('login.login');
                }
            }
            else
            {
                Session::flash('forgotpassworderror', 'Default admin unable to reset password.');
                return view('login.forgot-password');
            }
        }
        else{
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