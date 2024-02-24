<?php

namespace App\Http\Controllers\User\Auth;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Mail\{TfaVerificationCode};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Requests\User\TwoFactoryAuthentication\VerifyTwoFactoryAuthenticationRequest;

class TfaLoginController extends Controller
{
    /** 
     * To show the 2FA login form.
     * @return View
    */
    public function tfaLoginForm(Request $request): View {

        return view('users.auth.tfa_login');
    }

    /** 
     * To send 2FA verification code.
     * @param Request $request
     * @return RedirectResponse
    */
    public function verification_code(Request $request): RedirectResponse {

        try {

            $user = $request->get('user');

            Mail::to($user)->send(new TfaVerificationCode($user));

            return back()->with('success', __('messages.user.tfa_login.send_verification_code_success'));

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    /** 
     * To validate verification code & verify email.
     * 
     * @param VerifyTwoFactoryAuthenticationRequest $request
     * @return RedirectResponse
    */
    public function tfa_login(VerifyTwoFactoryAuthenticationRequest $request): RedirectResponse {

        try {

            $user = $request->get('user');

            if(time() > $user->verification_code_expiry) {

                Mail::to($user)->send(new TfaVerificationCode($user));

                throw new Exception(__('messages.user.tfa_login.code_expired'));
            };

            DB::beginTransaction();

            $result = $user->update([
                'tfa_verified' => true,
                'verification_code' => NULL,
                'verification_code_expiry' => NULL
            ]);

            throw_if(!$result, new Exception(__('messages.user.tfa_login.verificaion_failed')));

            DB::commit();

            Auth::login($user, $request->remember_me);

            return redirect()->route('user.dashboard')->with('success',__('messages.user.tfa_login.verificaion_success'));

        } catch(Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }
}
