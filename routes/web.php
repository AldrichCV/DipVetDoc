<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', [HomeController::class, 'Home'])->name('home');
Route::get('/Gallery', [HomeController::class, 'Gallery'])->name('gallery');
Route::get('/Clinic', [HomeController::class, 'Clinic'])->name('clinic');
Route::get('/Login', [HomeController::class, 'Login'])->name('login');

Route::get('/Admin', [AdminController::class, 'Dashboard'])->name('admin');



Route::get('/auth/google', function () {
    return Socialite::driver('google')->scopes([
        'openid', 'profile', 'email',
    ])->redirect();
});

Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    // Do your login or registration logic here
    dd($googleUser); // Test output
});