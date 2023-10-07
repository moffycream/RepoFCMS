<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class test extends Controller
{
    public function SampleMethod()
    {
        return view("login");
    }
    //
}