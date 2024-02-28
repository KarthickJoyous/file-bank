<?php

namespace App\Http\Controllers\Admin\Auth;

use Exception;
use App\Models\Admin;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Mail\Admin\{TfaVerificationCode};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Requests\Admin\TwoFactoryAuthentication\VerifyTwoFactoryAuthenticationRequest;

class TfaLoginController extends Controller
{
    /** 
     * To show the 2FA login form.
     * @return View
    */
    public function tfaLoginForm(Request $request): View {

        return view('admins.auth.tfa_login');
    }

    /** 
     * To send 2FA verification code.
     * @param Request $request
     * @return RedirectResponse
    */
    public function verification_code(Request $request): RedirectResponse {

        try {

            $admin = $request->get('admin');

            Mail::to($admin)->send(new TfaVerificationCode($admin));

            return back()->with('success', __('messages.admin.tfa_login.send_verification_code_success'));

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

            $admin = $request->get('admin');

            if(time() > $admin->verification_code_expiry) {

                Mail::to($admin)->send(new TfaVerificationCode($admin));

                throw new Exception(__('messages.admin.tfa_login.code_expired'));
            };

            DB::beginTransaction();

            $result = $admin->update([
                'tfa_verified' => true,
                'verification_code' => NULL,
                'verification_code_expiry' => NULL
            ]);

            throw_if(!$result, new Exception(__('messages.admin.tfa_login.verificaion_failed')));

            DB::commit();

            Auth::guard('admin')->login($admin, $request->remember_me);

            return redirect()->route('admin.dashboard')->with('success',__('messages.admin.tfa_login.verificaion_success'));

        } catch(Exception $e) {

            DB::rollback();

            return back()->with('error', $e->getMessage());
        }
    }
}
