<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
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
        $this->vetCount();
        $this->appointmentCount();
    }

    function vetCount()
    {
        View::composer('layouts.navigation', function ($view) {
        $pendingCount = DB::table('users')
            ->where('status', 'pending')
            ->count();

        $view->with('pendingCount', $pendingCount);
    });
    }

    function appointmentCount()
    {
        View::composer('layouts.navigation', function ($view) {
        $pendingAppointmentCount = DB::table('user_appointments')
            ->where('status', 'pending')
            ->count();

        $view->with('pendingAppointmentCount', $pendingAppointmentCount);
    });
    }
}
