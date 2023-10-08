<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

// validations
class PaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }

    public function showPaymentPage()
    {
        $totalPrice = DB::table('orders')->sum('total');
        $orders = DB::table('orders')->get();

        return view('payment', compact('totalPrice', 'orders'));
    }
}
