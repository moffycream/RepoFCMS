<?php

namespace App\Http\Controllers;
use App\Models\UserAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $username = Session::get('username');
        if (!$username)
        {
             // Redirect the user to the login page if not logged in
             return redirect('/login')->with('error', 'You are not logged in.');
        }
        $user = UserAccounts::where('username', $username)->first();
        if (!$user) {
            // Redirect to login if the user doesn't exist in the database
            return redirect('/register')->with('error', 'User not found.');
        }
        return view('profile', ['user' => $user]);
    }  
}
