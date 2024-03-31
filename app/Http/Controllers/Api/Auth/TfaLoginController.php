<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\{TfaVerificationCode};
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\Api\TwoFactoryAuthentication\VerifyTwoFactoryAuthenticationRequest;

class TfaLoginController extends Controller
{
    /** 
     * To send 2FA verification code.
     * @param Request $request
     * @return JsonResponse
    */
    public function verification_code(Request $request): JsonResponse {

        try {

            $user = $request->get('user');

            Mail::to($user)->send(new TfaVerificationCode($user));

            return $this->success(__('messages.user.tfa_login.send_verification_code_success'), []);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /** 
     * To validate verification code & verify email.
     * 
     * @param VerifyTwoFactoryAuthenticationRequest $request
     * @return JsonResponse
    */
    public function tfa_login(VerifyTwoFactoryAuthenticationRequest $request): JsonResponse {

        try {

            $user = $request->get('user');

            if(time() > $user->verification_code_expiry) {

                Mail::to($user)->send(new TfaVerificationCode($user));

                throw new Exception(__('messages.user.tfa_login.code_expired'), 422);
            };

            DB::transaction(function() use($user) {

                $result = $user->update([
                    'tfa_verified' => true,
                    'verification_code' => NULL,
                    'verification_code_expiry' => NULL
                ]);
    
                throw_if(!$result, new Exception(__('messages.user.tfa_login.verificaion_failed'), 500));
            });

            return $this->success(__('messages.user.tfa_login.verificaion_success'), [
                'token' => $user->createToken('api')->plainTextToken,
                'user' => new UserResource($user)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
