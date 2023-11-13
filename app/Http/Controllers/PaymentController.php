<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserAccountController;
use App\Models\Notification;
use App\Models\UserAccounts;
use App\Models\Order;
use App\Models\Menu;
use App\Models\MenuFood;
use App\Models\Food;
use App\Models\FoodInventory;
use App\Models\Inventory;
use App\Models\Membership;

// validations
class PaymentController extends Controller
{
    // used for verification
    protected $userAccountController;

    protected $membershipController;

    public function index(UserAccountController $userAccountController , MembershipController $membershipController)
    {
        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;
        
        if ($this->userAccountController->verifyCustomer()) {
            return view('payment', ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
    }

    public function storePaymentData(Request $request)
    {
        if (session()->has('username')) {
            $userID = UserAccounts::where('username', session('username'))->first()->userID;
            // Check if its null 
            if ($userID != null) {
                // Save the payment and associate it with an order
                // Retrieve the overallTotalPrice from the form input
                $overallTotalPrice = $request->input('overallTotalPrice');

                //  New order instance
                $payment = new Payment();

                // Populate the Payment model with the form data\
                $payment->userID = $userID;
                $payment->total_price  = $overallTotalPrice;
                $payment->payment_method = $request->input('PaymentMethod');
                $payment->orderID = $request->input('orderID'); // Set the orderID with the provided orderID

                // Set the 'bank' field based on the selected payment method
                if ($request->input('PaymentMethod') === 'OnlineBanking') {
                    $payment->bank = $request->input('selected_bank');
                    $payment->bank_username = $request->input('bank_username');
                    $payment->account_number = $request->input('account_number');
                    $payment->password = $request->input('bank_password');
                    $payment->amount_paid = $request->input('payment_amount');
                    $payment->description = $request->input('payment_description');

                    // set to none
                    $payment->card_number = "none";
                    $payment->cvv = "none";
                    $payment->cardholder_name = "none";
                    $payment->billing_address = "none";
                    $payment->ewallet_type = "none";
                    $payment->ewallet_username = "none";
                } elseif ($request->input('PaymentMethod') === 'CreditCard') {
                    $payment->card_number = $request->input('payment_cardNumber');
                    $payment->cvv = $request->input('payment_cvv');
                    $payment->cardholder_name = $request->input('payment_cardholder');
                    $payment->billing_address = $request->input('payment_billingAddress');
                    $payment->amount_paid = $request->input('payment_amount');
                    $payment->description = $request->input('payment_description');

                    // set to none
                    $payment->bank = "none";
                    $payment->bank_username = "none";
                    $payment->account_number = "none";
                    $payment->password = "none";
                    $payment->ewallet_type = "none";
                    $payment->ewallet_username = "none";
                } elseif ($request->input('PaymentMethod') === 'DebitCard') {
                    $payment->card_number = $request->input('payment_cardNumber');
                    $payment->cvv = $request->input('payment_cvv');
                    $payment->cardholder_name = $request->input('payment_cardholder');
                    $payment->billing_address = $request->input('payment_billingAddress');
                    $payment->amount_paid = $request->input('payment_amount');
                    $payment->description = $request->input('payment_description');

                    // set to none
                    $payment->bank = "none";
                    $payment->bank_username = "none";
                    $payment->account_number = "none";
                    $payment->password = "none";
                    $payment->ewallet_type = "none";
                    $payment->ewallet_username = "none";
                } elseif ($request->input('PaymentMethod') === 'Ewallet') {
                    $payment->ewallet_type = $request->input('eWallet_type');
                    $payment->ewallet_username = $request->input('ewallet_username');
                    $payment->amount_paid = $request->input('payment_amount');
                    $payment->description = $request->input('payment_description');

                    //  set to none
                    $payment->bank = "none";
                    $payment->bank_username = "none";
                    $payment->account_number = "none";
                    $payment->password = "none";
                    $payment->card_number = "none";
                    $payment->cvv = "none";
                    $payment->cardholder_name = "none";
                    $payment->billing_address = "none";
                }
                // Save the dta to the database
                $payment->save();

                // Decrease the ingredients
                $inventoryCounts = [];
                $orderInfos = array_combine($request->input('menuIDs'), $request->input('menuQuantities'));

                foreach ($orderInfos as $menuID => $menuQuantity) {
                    $menu = Menu::find($menuID);
                    $foods = MenuFood::where('menuID', $menu->menuID)->get();
                    foreach ($foods as $food) {
                        $inventories = FoodInventory::where('foodID', $food->foodID)->get();
                        foreach ($inventories as $inventory) {
                            $inventoryID = $inventory->inventoryID;
                            $inventoryCount = $inventory->amount;

                            if (array_key_exists($inventoryID, $inventoryCounts)) {
                                $inventoryCounts[$inventoryID] += ($inventoryCount * $menuQuantity);
                            } else {
                                $inventoryCounts[$inventoryID] = ($inventoryCount * $menuQuantity);
                            }
                        }
                    }
                }


                foreach ($inventoryCounts as $ID => $count) {
                    $inventory = Inventory::find($ID);
                    $inventory->amount -= $count;
                    $inventory->save();
                }

                return redirect()->route('payment.complete');
            }
        }
    }

    public function paymentComplete()
    {
        return view('payment-complete');
    }
}
