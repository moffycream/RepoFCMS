<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\ProfileController;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Get user profile
        View::composer('*', function ($view) {
            if (session()->has('username')) {
                $profileController = app(ProfileController::class);
                $profilePicture = $profileController->getProfilePicture();
        
                $view->with('profilePicture', $profilePicture);
            }
        });
    }
}
