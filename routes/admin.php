<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\{LoginController, ForgotPasswordController, TfaLoginController};

use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\Account\{AdminProfileController, ChangePasswordController, TwoFAController, LogoutController};
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/
Route::group(['as' => 'admin.'], function() {

	Route::group(['middleware' => ['guest:admin', 'throttle:50'] ], function() {

		Route::controller(LoginController::class)->group(function () {

			Route::get('login', 'loginForm')->name('loginForm');

			Route::post('login', 'login')->name('login');
		});

		Route::controller(ForgotPasswordController::class)->group(function () {

			Route::get('forgot_password', 'forgotPasswordForm')->name('forgotPasswordForm');

			Route::post('forgot_password', 'forgot_password')->name('forgot_password');

			Route::get('reset_password/{token}', 'resetPasswordLink')->name('resetPasswordLink');

			Route::post('reset_password/{token}', 'reset_password')->name('reset_password');
		});

		Route::group(['middleware' => ['adminTfaVerification']], function() {

			Route::controller(TfaLoginController::class)->group(function () {

				Route::get('tfa_login', 'tfaLoginForm')->name('tfaLoginForm');

				Route::get('tfa/verification_code', 'verification_code')->name('tfa_verification_code');

				Route::post('tfa_login', 'tfa_login')->name('tfa_login');
			});
		});
	});

	Route::group(['middleware' => ['auth:admin'] ], function() {

		Route::group(['middleware' => ['adminAppVerification']], function() {

			Route::get('', HomeController::class)->name('dashboard');

			Route::controller(AdminProfileController::class)->group(function() {

				Route::get('profile', 'profile')->name('profile');

				Route::post('update_profile', 'update_profile')->name('update_profile');
			});

			Route::post('change_password', ChangePasswordController::class)->name('change_password');

			Route::put('tfa_status', TwoFAController::class)->name('tfa_status');

			Route::get('logout', LogoutController::class)->name('logout');
		});
	});
});