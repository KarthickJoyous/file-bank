<?php

namespace App\Http\Controllers\User\EmailVerification;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Mail\User\{EmailVerificationCode, EmailVerified};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Requests\User\EmailVerification\VerifyEmailRequest;

class EmailVerificationController extends Controller
{
    /** 
     * To show the email verification form.
     * @return View
    */
    public function verifyEmailForm(): View {

        return view('users.auth.verify_email');
    }

    /** 
     * To send verification code.
     * @return RedirectResponse
    */
    public function verification_code(): RedirectResponse {

        try {

            $user = auth('web')->user();

            Mail::to($user)->send(new EmailVerificationCode($user));

            return back()->with('success', __('messages.user.email_verification.send_verification_code_success'));

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    /** 
     * To validate verification code & verify email.
     * 
     * @param VerifyEmailRequest $request
     * @return RedirectResponse
    */
    public function verify_email(VerifyEmailRequest $request): RedirectResponse {

        try {

            $user = auth('web')->user();

            if(time() > $user->verification_code_expiry) {

                Mail::to($user)->send(new EmailVerificationCode($user));

                throw new Exception(__('messages.user.email_verification.code_expired'));
            };

            DB::beginTransaction();

            $result = $user->update([
                'verification_code' => NULL,
                'verification_code_expiry' => NULL,
                'email_status' => EMAIL_VERIFIED,
                'email_verified_at' => now()
            ]);

            throw_if(!$result, new Exception(__('messages.user.email_verification.verificaion_failed')));

            DB::commit();

            Mail::to($user)->send(new EmailVerified($user));

            return redirect()->route('user.dashboard')->with('success',__('messages.user.email_verification.verificaion_success'));

        } catch(Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }
}
