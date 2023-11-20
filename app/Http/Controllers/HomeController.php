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
        $userAccountController->setDefaultAdmin();

        // Get the menu items
        $menuController = app(MenuController::class);
        $menuItems = $menuController->getMenuByRatings();

        if ($userAccountController->verifyCustomer()) {
            return view('welcome', ['menuItems' => $menuItems]);
        } else {
            return view('welcome', ['menuItems' => $menuItems]);
        }
    }


  

    public function menu()
    {
        // Checks whether is customer session or not
        $userAccountController = app(UserAccountController::class);

        if ($userAccountController->verifyCustomer()) {
            return view('menu');
        } else {
            return view('login.access-denied');
        }
    }

    public function about()
    {
        // Checks whether is customer session or not

        return view('about');
    }
}
