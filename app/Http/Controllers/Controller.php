<?php

namespace App\Http\Controllers;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;
    // Control navigation links
    public function handleNavLink($link)
    {
        if ($link == 'home')
        {
            return view('welcome');
        }
        else if ($link == 'menu')
        {
            return view('menu');
        }
        else if ($link == 'profile')
        {
            return view('profile');
        }
        else if ($link == 'about')
        {
            return view('about');
        }
        else if ($link == 'contact-us')
        {
            return view('contact-us');
        }
        else if ($link == 'add-menu')
        {
            return view('add-menu');
        }
        else if ($link == 'add-menu-form')
        {
            return view('add-menu-form');
        }
        else if ($link == 'add-food')
        {
            return view('menu/add-food');
        }
        else if ($link == 'add-food-form')
        {
            return view('add-food-form');
        }
        else if ($link == 'register')
        {
            return view('register');
        }
        else if ($link == 'register-successful')
        {
            return view('register-successful');
        }
        else if ($link == 'login')
        {
            return view('login');
        }
        else if($link == 'customer-orders')
        {
            return view('customer-orders');
        }
        else if($link == 'display-menu')
        {
            return view('display-menu');
        }
        else if($link == 'payment')
        {
            return view('payment');
        }
        else
        {
            // handle 404 
        }
    }
}
