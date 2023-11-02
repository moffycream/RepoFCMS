<?php

namespace App\Http\Controllers;

use App\Models\UserAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\NotificationController;

class ProfileController extends Controller
{
    public function index()
    {
        $notificationController = app(NotificationController::class);
        $username = Session::get('username');
        if (!$username) {
            // Redirect the user to the login page if not logged in
            return redirect('/login')->with('error', 'You are not logged in.');
        }
        $user = UserAccounts::where('username', $username)->first();
        if (!$user) {
            // Redirect to login if the user doesn't exist in the database
            return redirect('/register')->with('error', 'User not found.');
        }
        return view('customer.profile', ['user' => $user,  'notifications' => $notificationController->getNotification()]);
    }


    public function editProfile(Request $request)
    {
        $notificationController = app(NotificationController::class);
        $user = UserAccounts::find($request->userID);
        if ($user) {
            $user->username = $request->name;
            $user->save();

            return view('customer.profile', ['user' => $user,  'notifications' => $notificationController->getNotification()]);
        } 
        
        
    }
}
