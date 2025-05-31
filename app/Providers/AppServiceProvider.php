<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

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
        // Blade directive untuk mengecek apakah pengguna login via Firebase
        Blade::if('firebaseauth', function () {
            return Session::has('firebase_user_id');
        });

        // Blade directive untuk mengecek apakah pengguna adalah tamu (tidak login via Firebase)
        Blade::if('firebaseguest', function () {
            return !Session::has('firebase_user_id');
        });
    }
}
