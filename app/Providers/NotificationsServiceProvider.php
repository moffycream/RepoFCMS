<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\NotificationController; // Import your NotificationController
use Illuminate\Support\Facades\Auth; // Import the Auth facade if not already imported

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (session()->has('username')) {
                $notifications = app(NotificationController::class)->getNotification();

                $view->with('notifications', $notifications);
            }
        });
    }
}
