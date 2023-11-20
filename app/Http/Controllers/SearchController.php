<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;

class SearchController extends Controller
{
    // used for verification
    protected $userAccountController;

    // Retrieve function 
    public function index(UserAccountController $userAccountController)
    {

        // Checks whether is valid login or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer.search-result');
        } else {
            return view('login.access-denied');
        }
    }

    // Search function
    public function search(UserAccountController $userAccountController, Request $request)
    {
        $menu = Menu::where('name', 'like', '%' . $request->search . '%')->get();

        // Checks whether is valid login or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer.search-result', ['listItems' => $menu, 'search' => $request->search]);
        } else {
            return view('login.access-denied');
        }
    }

    // Search function
    public function filter(UserAccountController $userAccountController, Request $request)
    {
        $menu = Menu::where('name', 'like', '%' . $request->search . '%')->get();

        // Checks whether is valid login or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('customer.search-result', ['listItems' => $menu, 'search' => $request->search, 'filter' => $request->filter]);
        } else {
            return view('login.access-denied');
        }
    }
}
