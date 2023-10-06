<?php

namespace App\Http\Controllers;
use App\Models\UserAccounts;

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
            $_SESSION['accountType'] = $user->accountType;     // Store 'accountType' in a session variable
        
            // echo ($_SESSION['accountType']);
            echo "login successful";
            echo $_SESSION['accountType'];
        } 
        else {
            echo "failed login";
            session()->flush();   
        }
        return view('login');
    }
}