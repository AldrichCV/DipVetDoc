<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
            $pendingAppointmentCount = 0;

            if (Auth::check()) {
                if (Auth::user()->role === 'vet') {
                    // Pending appointments assigned to this vet
                    $pendingAppointmentCount = DB::table('user_appointments as ua')
                        ->leftJoin('assigned_vet as av', 'ua.id', '=', 'av.appointment_id')
                        ->where('ua.status', 'pending')
                        ->where('av.user_id', Auth::id())
                        ->count();
                } elseif (Auth::user()->role === 'admin') {
                    // All pending appointments
                    $pendingAppointmentCount = DB::table('user_appointments')
                        ->where('status', 'pending')
                        ->count();
                }
            }

            $view->with('pendingAppointmentCount', $pendingAppointmentCount);
        });
    }
}
