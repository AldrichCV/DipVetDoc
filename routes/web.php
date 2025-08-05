<?php

use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


Route::get('/', function () {
    return view('HomePage');})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users', [AdminController::class, 'index'])->middleware(['auth'])->name('users');
Route::get('/pets', [PetController::class, 'index'])->middleware(['auth'])->name('pets');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/user_dashboard', function () {
    return view('user_dashboard');
})->middleware(['auth']);

Route::get('auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

// Handle callback from Google
Route::get('auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'password' => bcrypt(Str::random(24)),
            'google_id' => $googleUser->getId(),
        ]
    );

    Auth::login($user);

    return redirect()->intended('/dashboard');
});

Route::get('/auth/facebook', [FacebookController::class, 'redirectToFacebook'])->name('facebook.login');
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

Route::get('/my_appointments', [UserController::class, 'appointments'])->name('my_appointments');
Route::post('/my_appointments', [UserController::class, 'store'])->name('appointments.store');
