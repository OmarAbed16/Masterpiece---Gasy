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
    //Route::get('profile', [ProfileController::class, 'create'])->name('profile');
    
    // Static Pages
    Route::view('billing', 'pages.billing')->name('billing');
    Route::view('rtl', 'pages.rtl')->name('rtl');
    Route::view('virtual-reality', 'pages.virtual-reality')->name('virtual-reality');
    Route::view('notifications', 'pages.notifications')->name('notifications');
    Route::view('static-sign-in', 'pages.static-sign-in')->name('static-sign-in');
    Route::view('static-sign-up', 'pages.static-sign-up')->name('static-sign-up');


    //MyProfile Pages
    Route::resource('MyProfile', ProfileController::class)->except(['create', 'store'])->names('MyProfile');
    Route::delete('MyProfile/delete/{MyProfile}', [ProfileController::class, 'destroy'])->name('MyProfile.destroy');
    Route::put('MyProfile/edit/{MyProfile}', [ProfileController::class, 'edit'])->name('MyProfile.edit');
    
    //Drivers Pages
    Route::resource('drivers', DriversController::class)->except(['create', 'store'])->names('drivers');
    Route::delete('drivers/delete/{driver}', [DriversController::class, 'destroy'])->name('drivers.destroy');
    Route::get('drivers/edit/{driver}', [DriversController::class, 'edit'])->name('drivers.edit');
    
    //Users Pages
    Route::resource('users', UsersController::class)->except(['create', 'store', 'show'])->names('users');
    Route::delete('users/delete/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::get('users/edit/{user}', [UsersController::class, 'edit'])->name('users.edit');

    Route::resource('orders', OrdersController::class)->except(['create', 'store'])->names('orders');
    Route::delete('orders/delete/{order}', [OrdersController::class, 'destroy'])->name('orders.destroy');

    Route::resource('reviews', RatingsController::class)->except(['create', 'store'])->names('reviews');
    Route::delete('reviews/delete/{review}', [RatingsController::class, 'destroy'])->name('reviews.destroy');

});
