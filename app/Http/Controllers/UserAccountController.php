<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\UserAccounts;

class UserAccountController extends Controller
{
    // Retrieve function 
    public function index() { 
        $accounts = UserAccounts::all(); 
        return view('login', ['listItems' => $accounts]);
    }    

    // register new account + validations
    public function registerNewAccount(Request $request) {
    $errorMsg = ""; // error message
    $accounts = new UserAccounts(); 
    $accounts->username = $request->username;
    if($request->password == $request->confirmpassword)
    {
        $accounts->password = $request->password;
    } 
    else
    {
        $errorMsg .= "Password and confirm password don't match<br>";
    }
    $phonePattern = '/^\d{10}$/';
    if(!preg_match($phonePattern,$request->phone))
    {
        $errorMsg .= "Invalid phone number<br>";
    }
    else
    {
        $accounts->phone = $request->phone;
    }
    $accounts->firstName = $request->firstName;
    $accounts->lastName = $request->lastName;
    if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) 
    {
        $errorMsg .= "Invalid email format<br>";
    }
    else
    {
        $accounts->email = $request->email;
    }
    $accounts->streetAddress = $request->streetAddress;
    $accounts->city = $request->city;
    if(!is_numeric($request->postcode))
    {
        $errorMsg .= "Invalid postcode<br>";
    }
    else
    {
        $accounts->postcode = $request->postcode;
    }
    $accounts->accountType = $request->accountType;
    
    if($errorMsg == "")
    {
        $accounts->save();
        return redirect('/register-success');
    }
    else
    {
        return view('register')->with('errorMsg', $errorMsg);
    }
} 

// create default admin 
public function createDefaultAdmin()
    {
        // checks whether the database have DefaultAdmin created already
        $record = UserAccounts::where('accountType', 'DefaultAdmin')->first();

        if(!$record)
        {
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
            $account->save(); 
        }
    }

    // Update function 
    public function update() { 

        $accounts = UserAccounts::find(1); 

        $accounts->topic = "Laravel"; 

        $accounts->save(); 

        echo "Update Successful!"; 

    } 

    // Delete function 
    public function delete() { 

        $accounts = UserAccounts::find(1); 

        $accounts->delete(); 

        echo "Delete Successful!"; 

    }
}
