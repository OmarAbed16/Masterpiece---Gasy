<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\UsersController;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('MyProfile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');

	
	// Route to show the list of all drivers
Route::get('/drivers', [DriversController::class, 'index'])->name('drivers.index');

// Route to view a specific driver's details
Route::get('/drivers/{id}', [DriversController::class, 'show'])->name('drivers.show');

// Route to show the edit form for a driver
Route::get('/drivers/{id}/edit', [DriversController::class, 'edit'])->name('drivers.edit');

// Route to update a driver's information
Route::put('/drivers/u/{id}', [DriversController::class, 'update'])->name('drivers.update');

// Route to delete a driver
Route::delete('/drivers/d/{id}', [DriversController::class, 'destroy'])->name('drivers.destroy');



// Route to show the edit form for a user
Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');

// Route to update a user's information
Route::put('/users/u/{id}', [UsersController::class, 'update'])->name('users.update');

// Route to delete a user
Route::delete('/users/d/{id}', [UsersController::class, 'destroy'])->name('users.destroy');



	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
Route::get('user-management', [ProfileController::class, 'userManagement'])->name('user-management');


	Route::get('MyProfile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});