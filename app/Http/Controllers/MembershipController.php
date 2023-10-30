<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UserAccountController;
use App\Models\Notification;

use Illuminate\Http\Request;

class MembershipController extends Controller
{
    protected $userAccountController;
    public function index(UserAccountController $userAccountController)
    {
        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('membership', ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }}
