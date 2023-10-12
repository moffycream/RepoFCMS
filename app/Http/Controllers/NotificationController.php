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
            $userID = UserAccounts::where('username', session('username'))->first()->userID;
            // Attempt to find the UserAccounts record
            $userAccounts = UserAccounts::find($userID);

            // Check if the record was found
            if ($userAccounts) {
                $userNotifications = $userAccounts->notifications;
                $unreadNotificationCount = $userNotifications->where('isRead', false);
                return $unreadNotificationCount;
            }
        }
        return collect(); // Return an empty collection if there are no notifications
    }
}
