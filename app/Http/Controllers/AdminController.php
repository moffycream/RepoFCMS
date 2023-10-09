<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function verifyAdmin()
    {
        if (session('accountType') != "Admin" && session('accountType') != "DefaultAdmin") {
            return false;
        }

        return true;
    }  
    
    public function index()
    {
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
        return view('admin.admin-register');    
    }

    public function adminBusinessAnalytics()
    {
        return view('admin.business-analytics');
    }
    public function adminEditProfile()
    {
        return view('admin.admin-edit-profile');
    }

    public function adminRegisterSuccess()
    {
        return view('admin.admin-register-success');
    }

    public function adminRegisterNewAccount(Request $request)
    {
        $errorMsg = ""; // error message
        $accounts = new UserAccounts();
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
        if ($request->accountType == "Customer" || $request->accountType == "Admin" || $request->accountType == "OperationTeam") {
            $accounts->accountType = $request->accountType;
        } else {
            $errorMsg .= "Invalid account type<br>";
        }

        if ($errorMsg == "") {
            $accounts->save();
            return redirect('/admin-register-success');
        } else {
            return view('admin.admin-register')->with('errorMsg', $errorMsg);
        }
    }
}