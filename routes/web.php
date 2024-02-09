<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\Auth\{RegisterController, LoginController};

use App\Http\Controllers\User\HomeController;

use App\Http\Controllers\User\Account\{UserProfileController, LogoutController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['as' => 'user.'], function() {

	Route::group(['middleware' => 'guest:web'], function() {

		Route::controller(RegisterController::class)->group(function () {

			Route::get('register', 'registerForm')->name('registerForm');

			Route::post('register', 'register')->name('register');
		});

		Route::controller(LoginController::class)->group(function () {

			Route::get('login', 'loginForm')->name('loginForm');

			Route::post('login', 'login')->name('login');
		});
	});

	Route::group(['middleware' => 'auth:web'], function() {

		Route::get('', HomeController::class)->name('dashboard');

		Route::controller(UserProfileController::class)->group(function() {

			Route::get('profile', 'profile')->name('profile');

			Route::post('update_profile', 'update_profile')->name('update_profile');

			Route::post('change_password', 'change_password')->name('change_password');
		});

		Route::post('logout', LogoutController::class)->name('logout');
	});
});