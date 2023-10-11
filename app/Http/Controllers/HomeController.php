<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserAccountController;
use App\Models\Notification;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // used for verification
    protected $userAccountController;
    public function index(UserAccountController $userAccountController)
    {
        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('welcome',['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function menu(UserAccountController $userAccountController)
    {
        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('menu');
        } else {
            return view('login.access-denied');
        }
    }

    public function about(UserAccountController $userAccountController)
    {
        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('about');
        } else {
            return view('login.access-denied');
        }
    }
}
