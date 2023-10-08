<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;

// validations
class PaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }
}
