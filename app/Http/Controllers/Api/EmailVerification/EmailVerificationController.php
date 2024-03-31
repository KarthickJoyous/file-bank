<?php

namespace App\Http\Controllers\Api\EmailVerification;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Mail\User\{EmailVerificationCode, EmailVerified};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\Api\EmailVerification\VerifyEmailRequest;
use App\Http\Resources\UserResource;

class EmailVerificationController extends Controller
{
    /** 
     * To send verification code.
     * 
     * @param Request $request
     * @return JsonResponse
    */
    public function verification_code(Request $request): JsonResponse {

        try {

            $user = $request->user();

            Mail::to($user)->send(new EmailVerificationCode($user));

            return $this->success(__('messages.user.email_verification.send_verification_code_success'), []);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /** 
     * To validate verification code & verify email.
     * 
     * @param VerifyEmailRequest $request
     * @return JsonResponse
    */
    public function verify_email(VerifyEmailRequest $request): JsonResponse {

        try {

            $user = $request->user();

            if(time() > $user->verification_code_expiry) {

                Mail::to($user)->send(new EmailVerificationCode($user));

                throw new Exception(__('messages.user.email_verification.code_expired'), 422);
            };

            $user = DB::transaction(function() use($user) {

                $result = $user->update([
                    'verification_code' => NULL,
                    'verification_code_expiry' => NULL,
                    'email_status' => EMAIL_VERIFIED,
                    'email_verified_at' => now()
                ]);
    
                throw_if(!$result, new Exception(__('messages.user.email_verification.verificaion_failed'), 500));

                return $user;
            });

            Mail::to($user)->send(new EmailVerified($user));

            return $this->success(__('messages.user.email_verification.verificaion_success'), [
                'user' => new UserResource($user)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
