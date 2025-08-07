<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| This file contains all the web routes for your Laravel application.
*/

// Public welcome page (Homepage)
Route::get('/', function () {
    return view('welcome');
});

// Authenticated dashboard view
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes that require the user to be authenticated
Route::middleware(['auth'])->group(function () {

    // Appointment Management Routes
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index'); // View all appointments
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create'); // Show appointment creation form
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store'); // Save new appointment

    Route::resource('pets', PetController::class); // Resourceful routes for PetController

    // Profile Management Routes
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Show profile edit form
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update'); // Save profile updates


});

// Authentication routes
require __DIR__.'/auth.php';

Route::get('/admin_dashboard', function () {
    return view('admin_dashboard');
})->middleware(['auth'])->name('admin');


Route::get('/user_dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('user_dashboard');

Route::get('/users', [AdminController::class, 'index'])->middleware(['auth'])->name('users');

Route::patch('/appointments/{id}/change-status', [AppointmentController::class, 'changeStatus'])
    ->name('appointments.changeStatus');
