<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use App\Models\Notification;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    // Retrieve function 
    public function index()
    {
        // create default admin 
        // checks whether the database have DefaultAdmin created already
        return view('login.login',['notifications' => Notification::all()]);
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
        }
        else{
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

    // register new account + validations
    public function registerNewAccount(Request $request)
    {
        $errorMsg = ""; // error message
        $accounts = new UserAccounts();

        $exist =  UserAccounts::where(UserAccounts::raw("BINARY username"), $request->username)->first();

        // checks if any existing account has same username or not
        if ($exist !== null)
        {
            
            // checks if the exisitng username is same as requested username (in terms of casing)
            // if (strcmp($exist->username, $request->username) == 0) 
            // {
            // if (strcmp($exist->username, $request->username) == 0) 
            // {
                $errorMsg .= "Username already exists<br>";
            //}
            // not the same casing (accepted)
            // else 
            // {
             //   $accounts->username = $request->username;
            //}
        }
        // don't have any same username
        else 
        {
            $accounts->username = $request->username;
            if ($request->password == $request->confirmpassword) {
                if (strlen($request->password) < 5) {
                    $errorMsg .= "Password must be more than 5 characters<br>";
                } else {
                    $accounts->password = Hash::make($request->password);
                }
            } else {
                $errorMsg .= "Password and confirm password don't match<br>";
            }
            $phonePattern = '/^\d{10}$/';
            if (!preg_match($phonePattern, $request->phone)) {
                $errorMsg .= "Invalid phone number<br>";
            } else {
                $accounts->phone = $request->phone;
            }
            $accounts->firstName = $request->firstName;
            $accounts->lastName = $request->lastName;
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid email format<br>";
            } else {
                $accounts->email = $request->email;
            }
            $accounts->streetAddress = $request->streetAddress;
            $accounts->city = $request->city;
            if (!is_numeric($request->postcode)) {
                $errorMsg .= "Invalid postcode<br>";
            } else {
                $accounts->postcode = $request->postcode;
            }
        }

        if ($errorMsg == "") {
            $accounts->accountType = "Customer";
            $accounts->save();
            return redirect('/register/register-success');
        } else {
            return view('login.register')->with('errorMsg', $errorMsg);
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
