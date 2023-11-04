<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\UserAccountController;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Notification;
use App\Models\UserAccounts;

use Carbon\Carbon;

// validations
class PurchaseController extends Controller
{
    protected $userAccountController;

    public function index(UserAccountController $userAccountController)
    {
        $orders = Order::all(); // Retrieve all orders from the database

        // Checks whether is customer session or not
        $this->userAccountController = $userAccountController;

        if ($this->userAccountController->verifyCustomer()) {
            return view('purchase', compact('orders'), ['notifications' => Notification::all()]);
        } else {
            return view('login.access-denied');
        }
        
    }

    public function ProcessPurchase(Request $request){
    $notificationController = app(NotificationController::class);
        if (session()->has('username')) {
            $userID = UserAccounts::where('username', session('username'))->first()->userID;
            if ($userID != null)
            {   
                
                // Retrieve the overallTotalPrice from the form input
                $overallTotalPrice = $request->input('overallTotalPrice');
                $menuNames = $request->input('menu_names'); // Retrieve an array of menu names
                $concatenatedMenuNames = implode(', ', $menuNames); // link all the menu name added

                //  New order instance
                $order = new Order();
                $order->userID = $userID;
                $order->order_notes = $request->input('purchase_orderNotes');
                $order->name = $request->input('purchase_realname');
                $order->address = $request->input('purchase_address');
                $order->contact = $request->input('purchase_contact');
                $order->delivery =$request->input('DeliveryMethod');

                $order->status = 'Pending'; // Manually set thestatus to "pending"
                $order->total = $overallTotalPrice;
                $order->menu_name = $concatenatedMenuNames; 

                $order->save();
            }
        }

        return view('payment', ['totalPrice' => $overallTotalPrice,'notifications' => $notificationController->getNotification()]);

    }
}
