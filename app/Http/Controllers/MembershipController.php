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

    public function UpdateMembership()
    {
        if (session()->has('username')) {
            $username = session('username');
            $user = UserAccounts::where('username', $username)->first();

            if ($user) {
                $userID = $user->userID;
                $totalAmountPaid = Payment::where('userID', $userID)->sum('amount_paid');

                // Calculate the tier based on the total amount paid
                $tier = $this->calculateTier($totalAmountPaid);
                $discountAmount = 0;
                $discountAmount = $this->getDiscountAmount($tier, $userID);

                // Store the data in the 'membership' table
                $membership = Membership::updateOrCreate(['userID' => $userID], ['tier_level' => $tier, 'total_payments' => $totalAmountPaid, 'discount_amount' => $discountAmount,]);

                // Retrieve remaining_discounts
                $remainingDiscounts = $membership->remaining_discounts;

                return view('membership', ['totalAmountPaid' => $totalAmountPaid, 'tier' => $tier, 'discountAmount'=> $discountAmount, 'discountRemaining'=> $remainingDiscounts]);
            }
        }
        return view('login.access-denied');
    }

    // Add this function to get the discount amount based on the tier
    public function getDiscountAmount($tier, $userID)
    {
        $membership = Membership::where('userID', $userID)->first();
        
        // if there is no record in the database
        if (!$membership) {
            return 0;
        }
        
        // get the remaining discount
        $remainingDiscounts = max(0, $membership->remaining_discounts);

        // Check if the remaining discounts are available
        if ($remainingDiscounts > 0) {
            switch ($tier) {
                case 1:
                    return 20; // RM20 for tier 1
                case 2:
                    return 30; // RM30 for tier 2
                case 3:
                    return 40; // RM40 for tier 3
                default:
                    return 0; // No discount 
            }
        }

        return 0;
    }

    public function updateRemainingDiscount($userID) 
    {
        $membership = Membership::where('userID', $userID)->first();

        if ($membership) {
            // Check if the remaining discounts > 0 and tier level is > 0
            if ($membership->remaining_discounts > 0 && $membership->tier_level > 0) {
                $membership->remaining_discounts -= 1;
                $membership->save();
            }
        }
    }

    public function resetRemainingDiscounts($userID)
    {
        $membership = Membership::where('userID', $userID)->first();

        if ($membership) {
            // Check if the last reset date is null or if the current month is different from the last reset second
            if ($membership->last_reset_date === null || date('m') != date('m', strtotime($membership->last_reset_date))) {
                // Reset remaining discounts for the membership
                $membership->remaining_discounts = 5;
                $membership->last_reset_date = now();
                $membership->save();
            }
        }
    }
}
