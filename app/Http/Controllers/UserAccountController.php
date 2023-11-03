<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use App\Models\Notification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ValidationController;

class UserAccountController extends Controller
{
    // Retrieve function 
    public function index()
    {
        // create default admin 
        // checks whether the database have DefaultAdmin created already
        return view('login.login', ['notifications' => Notification::all()]);
    }

    public function setDefaultAdmin()
    {
        $record = UserAccounts::where('accountType', 'DefaultAdmin')->first();
        if (!$record) {
            $account = new UserAccounts();
            $account->username = "FCMS";
            $account->password = "admin";
            $account->phone = "0191231234";
            $account->firstName = "FCMS";
            $account->lastName = "FCMS";
            $account->email = "FCMS@gmail.com";
            $account->streetAddress = "FCMS";
            $account->city = "FCMS";
            $account->postcode = "FCMS";
            $account->accountType = "DefaultAdmin";
            $account->imagePath = "profile-images/profile.png";

            $account->password = Hash::make($account->password);
            $account->save();
        }
    }

    public function verifyCustomer()
    {
        session_start();

        if (session('accountType') != "Customer") {
            Session(['accountType' => 'Guest']);
            return false;
        } else {
            return true;
        }
    }

    public function register()
    {
        return view('login.register');
    }

    public function registerSuccess()
    {
        return view('login.register-successful');
    }

    public function accessDenied()
    {
        return view('login.access-denied');
    }

    // register new account (as users)
    public function registerNewAccount(Request $request)
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
            $confirmPasswordErrorMsg = "";
            if (($validator->validatePassword($request))) {
                $accounts->password = Hash::make($request->password);
                $passwordErrorMsg = "";
            } else {
                $passwordErrorMsg = "Password must be more than 5 characters";
            }
        } else {
            $confirmPasswordErrorMsg = "Password does not match";
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
        // vaidate postcode

        $accounts->city = $request->city;
        if ($validator->validatePostcode($request)) {
            $accounts->postcode = $request->postcode;
        } else {
            $postcodeErrorMsg =  "Invalid postcode";
        }
        $accounts->imagePath = "profile-images/profile.png";


        if ($sameUsernameErrorMsg == "" && $passwordErrorMsg == "" && $confirmPasswordErrorMsg == "" && $emailErrorMsg == "" && $phoneErrorMsg == "" && $postcodeErrorMsg == "") {
            $accounts->accountType = "Customer";
            // set profile image to default image
            $accounts->imagePath = "profile-images/profile.png";

            // save the account to database if no error
            $accounts->save();

            // reset the form
            $request->replace([]);
            return redirect('/register/register-success');
        } else {
            return view('login.register')->with('sameUsernameErrorMsg', $sameUsernameErrorMsg)->with('passwordErrorMsg', $passwordErrorMsg)->with('confirmPasswordErrorMsg', $confirmPasswordErrorMsg)->with('emailErrorMsg', $emailErrorMsg)->with('phoneErrorMsg', $phoneErrorMsg)->with('postcodeErrorMsg', $postcodeErrorMsg);
        }
    }

    // Update function 
    public function update()
    {

        $accounts = UserAccounts::find(1);

        $accounts->topic = "Laravel";

        $accounts->save();

        echo "Update Successful!";
    }

    // Delete function 
    public function delete()
    {

        $accounts = UserAccounts::find(1);

        $accounts->delete();

        echo "Delete Successful!";
    }
}
