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
            if ($request->has('username')) {
                $user->username = $request->username;
                $user->save();
            }
            if ($request->has('phone')) {
                $user->phone = $request->phone;
                $user->save();
            }
            if ($request->has('first')) {
                $user->firstName = $request->first;
                $user->save();
            }
            if ($request->has('last')) {
                $user->lastName = $request->last;
                $user->save();
            }
            if ($request->has('email')) {
                $user->email = $request->email;
                $user->save();
            }
            if ($request->has('streetAddress')) {
                $user->streetAddress = $request->streetAddress;
                $user->save();
            }
            if ($request->has('city')) {
                $user->city = $request->city;
                $user->save();
            }
            if ($request->has('postcode')) {
                $user->postcode = $request->postcode;
                $user->save();
            }
            if ($request->hasFile('image')) {
            
                $fileName = time() . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('', $fileName, 'addProfile');
                $user->imagePath = 'profile-images/' . $path;
                $user->save();
            }
            return view('customer.profile', ['user' => $user,  'notifications' => $notificationController->getNotification()]);
        }
    }
}
