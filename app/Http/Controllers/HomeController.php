<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserAccountController;
use App\Models\Notification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // used for verification
    protected $userAccountController;
    public function index()
    {
        // Checks whether is customer session or not
        $userAccountController = app(UserAccountController::class);

        if ($userAccountController->verifyCustomer()) {
            return view('welcome',['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function menu()
    {
        // Checks whether is customer session or not
        $userAccountController = app(UserAccountController::class);

        if ($userAccountController->verifyCustomer()) {
            return view('menu', ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function about()
    {
        // Checks whether is customer session or not
        $userAccountController = app(UserAccountController::class);

        if ($userAccountController->verifyCustomer()) {
            return view('about', ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }
}
