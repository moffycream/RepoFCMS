<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function menu()
    {
        return view('menu');
    }

    public function about()
    {
        return view('about');
    }
}
