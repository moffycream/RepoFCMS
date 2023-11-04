<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // function to check login session as admin
    public function verifyAdmin()
    {
        if (session('accountType') != "Admin" && session('accountType') != "DefaultAdmin") {
            return false;
        }

        return true;
    }  

    // function to check login session as operation team
    public function verifyOperationTeam()
    {
        if (session('accountType') != "OperationTeam") {
            return false;
        }

        return true;
    }
    
    public function index()
    {
        // admin verification
        if($this->verifyAdmin())
        {
            return view('admin.admin-dashboard');
        }
        else
        {
            return view('login.access-denied');
        }
    }

    public function adminRegister()
    {
        // admin verification
        if ($this->verifyAdmin()) {
            return view('admin.admin-register');  
        } else {
            return view('login.access-denied');
        }
          
    }

    public function adminBusinessAnalytics()
    {
        // admin verification
        if ($this->verifyAdmin()) {
            return view('business-analytics');
        } else {
            return view('login.access-denied');
        }
        
    }
    public function adminEditProfile()
    {
        return view('admin.admin-edit-profile');
    }

    public function adminRegisterSuccess()
    {
        // admin verification
        if ($this->verifyAdmin()) {
            return view('admin.admin-register-success');
        } else {
            return view('login.access-denied');
        }
    }

    public function adminRegisterNewAccount(Request $request)
    {
        $validator = app(ValidationController::class);
        $accounts = new UserAccounts();

        // create individual error message for each error
        $sameUsernameErrorMsg = "";
        $passwordErrorMsg = "";
        $confirmPasswordErrorMsg = "";
        $emailErrorMsg = "";
        $phoneErrorMsg = "";
        $postcodeErrorMsg = "";

        // checks if any existing account has same username or not
        if (!($validator->validateSameUsername($request))) {
            $sameUsernameErrorMsg = "Username already exists";
        }
        // don't have any same username (means pass validations for username)
        else {
            $sameUsernameErrorMsg = "";
            $accounts->username = $request->username;
        }
        // validate password
        if (($validator->validateConfirmPassword($request))) {
            if (($validator->validatePassword($request))) {
                $accounts->password = Hash::make($request->password);
            } else {
                $passwordErrorMsg = "Password must be more than 5 characters";
            }
        } else {
            $confirmPasswordErrorMsg = "Password and confirm password don't match";
        }

        // validate phone
        if ($validator->validatePhone($request)) {
            $accounts->phone = $request->phone;
        } else {
            $phoneErrorMsg = "Invalid phone number";
        }

        $accounts->firstName = $request->firstName;
        $accounts->lastName = $request->lastName;

        // validate email
        if ($validator->validateEmail($request)) {
            $accounts->email = $request->email;
        } else {
            $emailErrorMsg = "Invalid email format";
        }
        $accounts->streetAddress = $request->streetAddress;
        $accounts->city = $request->city;


        if ($validator->validatePostcode($request)) {
            $accounts->postcode = $request->postcode;
        } else {
            $postcodeErrorMsg = "Invalid postcode";
        }
       
        $accounts->accountType = $request->accountType;
        $accounts->imagePath = "profile-images/profile.png";
    
        if ($sameUsernameErrorMsg == "" && $passwordErrorMsg == "" && $confirmPasswordErrorMsg == "" && $emailErrorMsg == "" && $phoneErrorMsg == "" && $postcodeErrorMsg == "") {
            // save the account to database if no error
            $accounts->imagePath = "profile-images/profile.png";
            $accounts->twoFactorAuth = 0;
            $accounts->isAuthenticated = 0;
            $accounts->firstTimeLogin = 0;
            $accounts->save();

            // reset the form
            $request->replace([]);
            return redirect('/admin-register-success');
        } else {
            return view('admin.admin-register')->with('sameUsernameErrorMsg', $sameUsernameErrorMsg)->with('passwordErrorMsg', $passwordErrorMsg)->with('confirmPasswordErrorMsg', $confirmPasswordErrorMsg)->with('emailErrorMsg', $emailErrorMsg)->with('phoneErrorMsg', $phoneErrorMsg)->with('postcodeErrorMsg', $postcodeErrorMsg);
        }
    }
}