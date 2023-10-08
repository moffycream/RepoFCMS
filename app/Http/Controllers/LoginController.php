<?php

namespace App\Http\Controllers;
use App\Models\UserAccounts;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // login function
    public function login(Request $request){
        session_start();

        // Validate the login credentials (You should connect to a database for this)
        $username = $request->username;
        $password = $request->password;

        $user = UserAccounts::where('username', $username)->first();
 
        if ($user && !strcmp($password, $user->password)) {
            // Authentication successful
            Session::put('username', $user->username); // Store the username in the session
            Session::put('accountType', $user->accountType); // Store 'accountType' in a session variable
            
            echo Session::get('accountType'); 
            echo "login successful";
        } 
        else {
            echo "failed login";
            session()->flush();   
        }
        return view('login');
    }
}