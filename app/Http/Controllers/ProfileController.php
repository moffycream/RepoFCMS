<?php

namespace App\Http\Controllers;
use App\Models\UserAccounts;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function retrieveInfo() { 

        $accounts = UserAccounts::all();
        return view('profile', ['listItems' => $accounts]);
    } 
}
