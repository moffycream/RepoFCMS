<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Hash;

class ValidationController extends Controller
{
    // double check this later
    public function validatePostcode(Request $request)
    {
        if (is_numeric($request->postcode)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateEmail(Request $request)
    {
        $emailPattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($emailPattern, $request->email)) {
            return true;
        } else {
            return false;
        }
    }

    public function validatePhone(Request $request)
    {
        $phonePattern = '/^\d{10}$/';
        if (preg_match($phonePattern, $request->phone)) {
            return true;
        } else {
            return false;
        }
    }

    public function validateTypeOfFeedback(Request $request)
    {
        if ($request->typeoffeedback == "none") {
            return false;
        } else {
            return true;
        }
    }

    public function validateSameUsername(Request $request)
    {
        // if there is a username in the database that is the same as the input
        if (UserAccounts::where('username', $request->username)->first()) {
            return false;
        } else {
            return true;
        }
    }

    public function validatePassword(Request $request)
    {
        if ($request->password == $request->confirmpassword) {
            if (strlen($request->password) < 5) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    public function validateConfirmPassword(Request $request)
    {
        if ($request->password == $request->confirmpassword) {
            return true;
        } else {
            return false;
        }
    }

    public function validateLogin(Request $request)
    {
        session_start();
        $username = $request->username;
        $password = $request->password;

        $user = UserAccounts::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Session::put('username', $user->username); // Store the username in the session
            Session::put('accountType', $user->accountType); // Store 'accountType' in a session variable

            // reset login request (or else error message might maintain)
            $request->replace([]);
            return true;
        } else {
            return false;
        }
    }
}
