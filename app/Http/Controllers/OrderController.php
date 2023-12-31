<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\AdminController;


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
        $selectedOrder->status_update_time = now();
        $selectedOrder->save();

        $notificationController->createNotification('Order ' . $orderID . ' has been accepted.', $selectedOrder->userID);
        return view('operation.op-view-order', ['orders' => $orders, 'selectedOrder' => $selectedOrder, 'notifications' => $notificationController->getNotification()]);
    }

    public function readyForPickupOrder($orderID)
    {
        $notificationController = app(NotificationController::class);
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        if ($selectedOrder->delivery == "Delivery") {
            $selectedOrder->status = "Delivery on the way";
        } else if ($selectedOrder->delivery == "Self-pickup") {
            $selectedOrder->status = "Ready for pickup";
        } else
        {
            $selectedOrder->status = "Ready for pickup";
        }
        $selectedOrder->status_update_time = now();
        $selectedOrder->save();

        $notificationController->createNotification('Order ' . $orderID . ' is ready for pickup.', $selectedOrder->userID);
        return view('operation.op-view-order', ['orders' => $orders, 'selectedOrder' => $selectedOrder, 'notifications' => $notificationController->getNotification()]);
    }

    public function completeOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "Completed";
        $selectedOrder->updated_at = now();
        $selectedOrder->status_update_time = now();
        $selectedOrder->save();

        $notificationController = app(NotificationController::class);
        $notificationController->createNotification('Order ' . $orderID . ' has been completed.', $selectedOrder->userID);

        return redirect('/op-orders')->with(['orders' => $orders]);
    }

    public function cancelOrder($orderID)
    {
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "Order Cancelled. The refund will be done within 5-7 working days.";
        $selectedOrder->status_update_time = now();
        $selectedOrder->save();
        Order::updateOrCreate(['orderID' => $orderID], ['status' => $selectedOrder->status,'status_update_time' => $selectedOrder->status_update_time,]);

        $notificationController = app(NotificationController::class);
        $notificationController->createNotification('Order ' . $orderID . ' has been cancelled.', $selectedOrder->userID);
        return redirect('/op-orders')->with(['orders' => $orders]);
    }

    public function refundOrder($orderID)
    {
        // Refund the order
        $orders = Order::all();
        $selectedOrder = Order::find($orderID);
        $selectedOrder->status = "Refunded";
        $selectedOrder->status_update_time = now();
        $selectedOrder->save();
        $notificationController = app(NotificationController::class);
        $notificationController->createNotification('Order ' . $orderID . ' has been refunded.', $selectedOrder->userID);
        return redirect('/op-orders')->with(['orders' => $orders]);
    }
}
