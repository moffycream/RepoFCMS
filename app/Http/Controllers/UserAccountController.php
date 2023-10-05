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

    // Insert function 
    public function registerNewAccount(Request $request) { 
    $accounts = new UserAccounts(); 
    $accounts->username = $request->username;
    $accounts->password = $request->password;
    $accounts->phone = $request->phone;
    $accounts->firstName = $request->firstName;
    $accounts->lastName = $request->lastName;
    $accounts->email = $request->email;
    $accounts->streetAddress = $request->streetAddress;
    $accounts->city = $request->city;
    $accounts->postcode = $request->postcode;
    $accounts->accountType = $request->accountType;
    $accounts->save();

    return redirect('/register-success');
} 

// create default admin 
public function createDefaultAdmin()
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
        
        // Return a JSON response to indicate success
        return response()->json(['message' => 'Default account created successfully'], 201);
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
