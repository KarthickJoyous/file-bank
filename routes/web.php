<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\Auth\{RegisterController, LoginController, ForgotPasswordController, TfaLoginController};

use App\Http\Controllers\User\HomeController;

use App\Http\Controllers\User\EmailVerification\{EmailVerificationController};

use App\Http\Controllers\User\Account\{UserProfileController, ChangePasswordController, TwoFAController, LogoutController, DeleteAccountController};

use App\Http\Controllers\User\Folder\{FolderController};

use App\Http\Controllers\User\File\{FileController};
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

	Route::group(['middleware' => ['guest:web', 'throttle:50'] ], function() {

		Route::controller(RegisterController::class)->group(function () {

			Route::get('register', 'registerForm')->name('registerForm');

			Route::post('register', 'register')->name('register');
		});

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

		Route::group(['middleware' => ['userTfaVerification']], function() {

			Route::controller(TfaLoginController::class)->group(function () {

				Route::get('tfa_login', 'tfaLoginForm')->name('tfaLoginForm');

				Route::get('tfa/verification_code', 'verification_code')->name('tfa_verification_code');

				Route::post('tfa_login', 'tfa_login')->name('tfa_login');
			});
		});
	});

	Route::group(['middleware' => ['auth:web'] ], function() {

		Route::group(['middleware' => ['emailVerified', 'throttle:50']], function() {

			Route::controller(EmailVerificationController::class)->group(function () {

				Route::get('verify_email', 'verifyEmailForm')->name('verifyEmailForm');

				Route::get('email/verification_code', 'verification_code')->name('email_verification_code');

				Route::post('verify_email', 'verify_email')->name('verify_email');
			});
		});

		Route::group(['middleware' => ['userAppVerification']], function() {

			Route::get('', HomeController::class)->name('dashboard');

			Route::controller(UserProfileController::class)->group(function() {

				Route::get('profile', 'profile')->name('profile');

				Route::post('update_profile', 'update_profile')->name('update_profile');
			});

			Route::post('change_password', ChangePasswordController::class)->name('change_password');

			Route::put('tfa_status', TwoFAController::class)->name('tfa_status');

			Route::delete('delete_account', DeleteAccountController::class)->name('delete_account');

			Route::put('set_folder_color', [FolderController::class, 'set_folder_color'])->name('folders.set_folder_color');

			Route::resource('folders', FolderController::class)->except(['create', 'edit']);

			Route::resource('files', FileController::class)->except(['create', 'edit']);
		});

		Route::get('logout', LogoutController::class)->name('logout');
	});
});