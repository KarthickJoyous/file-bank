<?php

namespace App\Http\Controllers\User\Auth;

use Exception;
use Illuminate\View\View;
use App\Mail\{PasswordResetLink, PasswordResetSuccess};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\{RedirectResponse};
use App\Models\{PasswordResetToken, User};
use App\Http\Requests\User\Auth\{ForgotPasswordEmailRequest, ResetPasswordRequest};

class ForgotPasswordController extends Controller
{
    /** 
     * To show the forgot password form.
     * @return View
    */
    public function forgotPasswordForm(): View {

        return view('users.auth.forgot_password');
    }

    /** 
     * To validate email & send link to email.
     * 
     * @param ForgotPasswordEmailRequest $request
     * @return RedirectResponse
    */
    public function forgot_password(ForgotPasswordEmailRequest $request): RedirectResponse {

        try {

            $user = User::select(['id', 'name', 'email'])->firstWhere(['email' => $request->email]);

            Mail::to($user)->send(new PasswordResetLink($user));

            return back()->with('success', __('messages.user.forgot_password.send_link_success'));

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }
    
    /** 
     * To validate token & show reset password form.
     * 
     * @param string $token
     * @return RedirectResponse
    */
    public function resetPasswordLink($token) {

        try {

            $password_reset_token = PasswordResetToken::firstWhere(['token' => $token]);

            throw_if(!$password_reset_token, new Exception);
            
            return view('users.auth.reset_password')->with('token', $token);

        } catch(Exception $e) {

            abort(403);
        }
    }

    /** 
     * To validate token & reset password.
     * 
     * @param ResetPasswordRequest $request
     * @param string $token
     * @return RedirectResponse
    */
    public function reset_password(ResetPasswordRequest $request, $token) {

        try {

            $password_reset_token = PasswordResetToken::firstWhere(['token' => $token]);

            throw_if(!$password_reset_token, new Exception);

            $user = User::firstWhere(['email' => $password_reset_token->email]);

            $user->update([
                'password' => Hash::make($request->password),
                'last_password_reset_at' => now()
            ]);

            PasswordResetToken::where(['email' => $user->email])->delete();

            Mail::to($user)->send(new PasswordResetSuccess($user));
            
            return redirect()->route('user.login')->with('success',__('messages.user.reset_password.reset_password_success'));

        } catch(Exception $e) {

            abort(403);
        }
    }
}
