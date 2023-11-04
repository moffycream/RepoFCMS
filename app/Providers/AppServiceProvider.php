<?php

namespace App\Providers;

use App\Models\UserAccounts;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



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
    public function boot(): void
    {
        // Get user profile
        View::composer('*', function ($view) {
            if (session()->has('username')) {
           
         
            }
        });
    }
}
