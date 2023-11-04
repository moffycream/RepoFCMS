<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // used for verification
    protected $userAccountController;
    public function index()
    {
        // Checks whether is customer session or not
        $userAccountController = app(UserAccountController::class);
        $notificationController = app(NotificationController::class);
        $userAccountController->setDefaultAdmin();


        if ($userAccountController->verifyCustomer()) {
            return view('welcome');
        } else {
            return view('welcome');
        }
    }

  

    public function menu()
    {
        // Checks whether is customer session or not
        $userAccountController = app(UserAccountController::class);
        $notificationController = app(NotificationController::class);

        if ($userAccountController->verifyCustomer()) {
            return view('menu', ['notifications' => $notificationController->getNotification()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function about()
    {
        // Checks whether is customer session or not
        $notificationController = app(NotificationController::class);

        return view('about', ['notifications' => $notificationController->getNotification()]);
    }
}
