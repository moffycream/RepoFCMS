<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UserAccountController;
use App\Models\Notification;
use App\Models\UserAccounts;
use App\Models\Payment;
use App\Models\Membership;

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
    }

    public function stormembership(Request $request){
        if (session()->has('username')) {
            $userID = UserAccounts::where('username', session('username'))->first()->userID;
            if ($userID != null){   
                // Retrieve payment data for the user
                $payments = Payment::where('userID', $userID->userID)->get();

                // Calculate the total spent
                $totalSpent = $payments->sum('total_price');

                // Determine the tier based on the total spent
                $tier = $this->calculateTier($totalSpent);

            }
        }
    }

    private function calculateTier($totalSpent){
        //  Calculate tier level based on spending
        if ($totalSpent >= 0 && $totalSpent < 300) {
             //tier 0
            return 0;

        } elseif ($totalSpent >= 300 && $totalSpent < 600) {
            //tier 1
            return 1;

        } elseif($totalSpent >= 600 && $totalSpent < 1000){
            //tier 2
            return 2;

        } elseif($totalSpent >= 1000 && $totalSpent < 1500){
            //tier 3
            return 3;     
        }
    }

    public function displayTotalAmountPaid()
    {
        if (session()->has('username')) {
            $username = session('username');
            $user = UserAccounts::where('username', $username)->first();

            if ($user) {
                $userID = $user->userID;
                $totalAmountPaid = Payment::where('userID', $userID)->sum('amount_paid');

                // Calculate the tier based on the total amount paid
                $tier = $this->calculateTier($totalAmountPaid);

                // Store the data in the 'membership' table
                Membership::updateOrCreate(['userID' => $userID], ['tier_level' => $tier, 'total_payments' => $totalAmountPaid]);

                return view('membership', ['totalAmountPaid' => $totalAmountPaid, 'tier' => $tier,]);
            }
        }
        return view('login.access-denied');
    }
}
