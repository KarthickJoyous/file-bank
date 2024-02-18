<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\Auth\{RegisterController, LoginController};

use App\Http\Controllers\User\HomeController;

use App\Http\Controllers\User\EmailVerification\{EmailVerificationController};

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

			Route::get('register', 'registerForm')->name('registerForm')->middleware('throttle:5');

			Route::post('register', 'register')->name('register');
		});

		Route::controller(LoginController::class)->group(function () {

			Route::get('login', 'loginForm')->name('loginForm')->middleware('throttle:5');

			Route::post('login', 'login')->name('login');
		});
	});

	Route::group(['middleware' => ['auth:web'] ], function() {

		Route::group(['middleware' => ['emailVerified', 'throttle:5']], function() {

			Route::controller(EmailVerificationController::class)->group(function () {

				Route::get('verify_email', 'verifyEmailForm')->name('verifyEmailForm');

				Route::get('verification_code', 'verification_code')->name('verification_code');

				Route::post('verify_email', 'verify_email')->name('verify_email');
			});
		});

		Route::group(['middleware' => ['appVerification']], function() {

			Route::get('', HomeController::class)->name('dashboard');

			Route::controller(UserProfileController::class)->group(function() {

				Route::get('profile', 'profile')->name('profile');

				Route::post('update_profile', 'update_profile')->name('update_profile');

				Route::post('change_password', 'change_password')->name('change_password');
			});

			Route::get('logout', LogoutController::class)->name('logout');
		});
	});
});