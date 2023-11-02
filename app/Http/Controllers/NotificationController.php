<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\UserAccounts;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = Notification::find($id);

        if ($notification) {
            $notification->update(['isRead' => true]);
        }

        return redirect()->back(); // Redirect back to the previous page
    }

    public function getNotification()
    {
        // Check if 'userID' exists in the session
        if (session()->has('username')) {
            $userAccount = UserAccounts::where('username', session('username'))->first();
            if ($userAccount != null) {
                // Check if the record was found
                $userNotifications = $userAccount->notifications;
                $unreadNotificationCount = $userNotifications->where('isRead', false);
                return $unreadNotificationCount;
            }
        }
        return collect(); // Return an empty collection if there are no notifications
    }

    public function createNotification($content, $userID)
    {
        $notification = new Notification();
        $notification->content = $content;
        $notification->userID = $userID;
        $notification->isRead = false;
        $notification->save();
    }

    public function notifyOperationTeam($content)
    {
        $operationTeam = UserAccounts::where('accountType', 'OperationTeam')->get();
        foreach ($operationTeam as $operation) {
            $this->createNotification($content, $operation->userID);
        }
    }
}
