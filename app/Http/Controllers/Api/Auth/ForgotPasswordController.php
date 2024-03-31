<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{JsonResponse};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\{PasswordResetToken, User};
use App\Mail\User\{PasswordResetCode, PasswordResetSuccess};
use App\Http\Requests\Api\Auth\{ForgotPasswordEmailRequest, ForgotPasswordCodeRequest, ResetPasswordRequest};

class ForgotPasswordController extends Controller
{
    /** 
     * To validate email & send link to email.
     * 
     * @param ForgotPasswordEmailRequest $request
     * @return JsonResponse
    */
    public function forgot_password(ForgotPasswordEmailRequest $request): JsonResponse {

        try {

            $user = User::select(['id', 'name', 'email'])->firstWhere(['email' => $request->email]);

            Mail::to($user)->send(new PasswordResetCode($user));

            return $this->success(__('messages.user.forgot_password.code_link_success'), []);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
    
    /** 
     * To validate code & send a token.
     * 
     * @param ForgotPasswordCodeRequest $request
     * @return JsonResponse
    */
    public function generate_token(ForgotPasswordCodeRequest $request): JsonResponse {

        try {

            $user = User::select(['id', 'name', 'email', 'verification_code_expiry'])->firstWhere(['email' => $request->email]);

            if(time() > $user->verification_code_expiry) {

                Mail::to($user)->send(new PasswordResetCode($user));

                throw new Exception(__('messages.user.email_verification.code_expired'), 422);
            };

            $token = DB::transaction(function() use($user) {

                PasswordResetToken::where(['email' => $user->email])->delete();

                $token = Str::random(150);

                $password_reset_token = PasswordResetToken::insert([
                    'email' => $user->email,
                    'token' => $token,
                    'created_at' => now()
                ]);

                throw_if(!$password_reset_token, new Exception('', 500));

                $user = $user->update([
                    'verification_code' => NULL,
                    'verification_code_expiry' => NULL
                ]);

                throw_if(!$user, new Exception('', 500));

                return $token;
            });
            
            return $this->success('', [
                'token' => $token
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /** 
     * To validate token & reset password.
     * 
     * @param ResetPasswordRequest $request
     * @param string $token
     * @return JsonResponse
    */
    public function reset_password(ResetPasswordRequest $request, $token): JsonResponse {

        try {

            $password_reset_token = PasswordResetToken::firstWhere(['token' => $token]);

            throw_if(!$password_reset_token, new Exception);

            $user = User::firstWhere(['email' => $password_reset_token->email]);

            throw_if(!$user, new Exception);

            DB::transaction(function() use($user, $request) {

                $password_reset_result = $user->update([
                    'password' => Hash::make($request->password),
                    'last_password_reset_at' => now()
                ]);

                throw_if(!$password_reset_result, new Exception);

                throw_if(!PasswordResetToken::where(['email' => $user->email])->delete(), new Exception);
            });

            Mail::to($user)->send(new PasswordResetSuccess($user));

            return $this->success(__('messages.user.reset_password.reset_password_success'), []);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), 403);
        }
    }
}
