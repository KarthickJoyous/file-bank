<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\HomeController;

use App\Http\Controllers\Api\File\{FileController};

use App\Http\Controllers\Api\Folder\{FolderController};

use App\Http\Controllers\Api\Passbook\PassbookController;

use App\Http\Controllers\Api\EmailVerification\{EmailVerificationController};

use App\Http\Controllers\Api\Auth\{RegisterController, LoginController, ForgotPasswordController, TfaLoginController};

use App\Http\Controllers\Api\Account\{UserProfileController, ChangePasswordController, TwoFAController, LogoutController, DeleteAccountController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'user', 'middleware' => ['apiLogger']], function() {

	Route::group(['middleware' => ['throttle:50'] ], function() {

		Route::post('register', RegisterController::class);

		Route::post('login', LoginController::class);

		Route::controller(ForgotPasswordController::class)->group(function () {

			Route::get('forgot_password', 'forgot_password');

			Route::get('reset_password/token', 'generate_token');

			Route::post('reset_password/{token}', 'reset_password');
		});

		Route::group(['middleware' => ['userTfaVerification']], function() {

			Route::controller(TfaLoginController::class)->group(function () {

				Route::get('tfa/verification_code', 'verification_code');

				Route::post('tfa/login', 'tfa_login');
			});
		});
	});

	Route::group(['middleware' => ['auth:sanctum'] ], function() {

		Route::group(['middleware' => ['throttle:50']], function() {

			Route::controller(EmailVerificationController::class)->group(function () {

				Route::get('email/verification_code', 'verification_code');

				Route::post('email/verify', 'verify_email');
			});
		});

		Route::group(['middleware' => ['userAppVerification']], function() {

			Route::get('home', HomeController::class);

			Route::controller(UserProfileController::class)->group(function() {

				Route::get('profile', 'profile');

				Route::post('update_profile', 'update_profile');
			});

			Route::post('change_password', ChangePasswordController::class);

			Route::put('tfa_status', TwoFAController::class);

			Route::delete('delete_account', DeleteAccountController::class);

			Route::put('set_folder_color', [FolderController::class, 'set_folder_color']);

			Route::apiResource('folders', FolderController::class)->missing(function() {

				return response()->json([
					'success' => false,
					'message' => __('messages.user.folders.not_found'),
					'code' => 404
				], 404);
			});

			Route::apiResource('files', FileController::class)->except(['update'])->missing(function() {

				return response()->json([
					'success' => false,
					'message' => __('messages.user.files.not_found'),
					'code' => 404
				], 404);
			});;
		});

		Route::get('passbook', PassbookController::class);

		Route::post('logout', LogoutController::class);
	});
});
