<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('HomePage');
})->name('home');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    // Pass a flag so the view knows this was the "logout initiator"
    return response()->view('auth.logged-out', [
        'initiator' => true,
    ]);
})->name('logout');


Route::get('/logged-out', function () {
    return view('auth.logged-out');
})->name('logged-out');

