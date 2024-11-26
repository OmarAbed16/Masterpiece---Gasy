<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ProfileController,
    RegisterController,
    SessionsController,
    DriversController,
    UsersController,
    OrdersController,
    RatingsController
};

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::redirect('/', 'sign-in');
    Route::get('sign-up', [RegisterController::class, 'create'])->name('register');
    Route::post('sign-up', [RegisterController::class, 'store']);
    Route::get('sign-in', [SessionsController::class, 'create'])->name('login');
    Route::post('sign-in', [SessionsController::class, 'store']);
    Route::post('verify', [SessionsController::class, 'show']);
    Route::post('reset-password', [SessionsController::class, 'update'])->name('password.update');
    Route::get('verify', fn() => view('sessions.password.verify'))->name('verify');
    Route::get('reset-password/{token}', fn($token) => view('sessions.password.reset', ['token' => $token]))->name('password.reset');
});

// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('sign-out', [SessionsController::class, 'destroy'])->name('logout');

    // Profile Routes
    Route::get('profile', [ProfileController::class, 'create'])->name('profile');
    Route::post('MyProfile', [ProfileController::class, 'update']);
    Route::get('user-management', [ProfileController::class, 'userManagement'])->name('user-management');
    Route::get('MyProfile', fn() => view('pages.laravel-examples.user-profile'))->name('user-profile');

    // Static Pages
    Route::view('billing', 'pages.billing')->name('billing');
    Route::view('rtl', 'pages.rtl')->name('rtl');
    Route::view('virtual-reality', 'pages.virtual-reality')->name('virtual-reality');
    Route::view('notifications', 'pages.notifications')->name('notifications');
    Route::view('static-sign-in', 'pages.static-sign-in')->name('static-sign-in');
    Route::view('static-sign-up', 'pages.static-sign-up')->name('static-sign-up');

    // Resourceful Routes
    Route::resource('drivers', DriversController::class)->except(['create', 'store']);
    Route::resource('users', UsersController::class)->except(['index', 'create', 'store', 'show']);
    Route::resource('orders', OrdersController::class)->except(['create', 'store']);
    Route::resource('reviews', RatingsController::class)->except(['create', 'store']);
});
