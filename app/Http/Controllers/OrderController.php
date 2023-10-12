<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Notification;
use App\Http\Controllers\AdminController;
use App\Models\UserAccounts;

class OrderController extends Controller
{
    // used for verification
    protected $adminController;

    public function index()
    {
        $orders = Order::all();

        // Checks whether is valid login or not
        $adminController = app(AdminController::class);
        $notificationController = app(NotificationController::class);
        
        // checks whether it is operation team or is admin, if either one access is allow
        if ($adminController->verifyOperationTeam() || $adminController->verifyAdmin()) {
            return view('operation.op-orders', ['orders' => $orders, 'notifications' => $notificationController->getNotification()]);
        } else {
            return view('login.access-denied');
        }
    }
 

    public function viewOrder($orderID)
    {
        $notificationController = app(NotificationController::class);
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        return view('operation.op-view-order', ['orders' => $orders, 'selectedOrder' => $selectedOrder,'notifications' => $notificationController->getNotification()]);
    }

    public function acceptOrder($orderID)
    {
        $notificationController = app(NotificationController::class);
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "Preparing";
        $selectedOrder->save();

        $notification = new Notification();
        $notification->userID = $selectedOrder->userID;
        $notification->content = 'Your order#' . $orderID . ' is processing';
        $notification->save();

        return view('operation.op-view-order', ['orders' => $orders, 'selectedOrder' => $selectedOrder, 'notifications' => $notificationController->getNotification()]);
    }

    public function readyForPickupOrder($orderID)
    {
        $notificationController = app(NotificationController::class);
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "Ready for pickup";
        $selectedOrder->save();

        $notification = new Notification();
        $notification->userID = $selectedOrder->userID;
        $notification->content = 'Your order#' . $orderID . ' is ready for pickup';
        $notification->save();

        return view('operation.op-view-order', ['orders' => $orders, 'selectedOrder' => $selectedOrder, 'notifications' => $notificationController->getNotification()]);
    }

    public function completeOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "Completed";
        $selectedOrder->save();

        $notification = new Notification();
        $notification->userID = $selectedOrder->userID;
        $notification->content = 'Your order#' . $orderID . ' is completed';
        $notification->save();

        return redirect('/op-orders')->with(['orders' => $orders]);
    }

    public function cancelOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "Cancelled";
        $selectedOrder->save();

        $notification = new Notification();
        $notification->userID = $selectedOrder->userID;
        $notification->content = 'Your order#' . $orderID . ' is cancelled';
        $notification->save();
        return redirect('/op-orders')->with(['orders' => $orders]);
    }
}
