<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\NotificationController;
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
                if ($notifications != null)
                {
                    $view->with('notifications', $notifications);
                }
                else
                {
                    $view->with('notifications', null);
                }
            }
        });
    }
}
