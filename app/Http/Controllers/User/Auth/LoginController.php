<?php

namespace App\Http\Controllers\User\Auth;

use Exception;
use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\{RedirectResponse};
use App\Http\Requests\User\Auth\UserLoginRequest;
use App\Actions\User\TwoFactoryAuthentication;

class LoginController extends Controller
{   
    /** 
     * To show the login form.
     * @return View
    */
    public function loginForm(): View {

        return view('users.auth.login');
    }

    /** 
     * To register an user to application.
     * @param UserLoginRequest $request
     * @return RedirectResponse  
    */
    public function login(UserLoginRequest $request) {

        try {

            $user = User::firstWhere(['email' => $request->email]);

            $login = Hash::check($request->password, $user->password);

            throw_if(!$login, new Exception(__('messages.user.login.invalid_credentials')));

            if($user->tfa_status) {

                return (new TwoFactoryAuthentication)->handle($user);
            }

            Auth::login($user, $request->remember_me);

            return redirect()->route('user.dashboard')->with('success', __('messages.user.login.login_success'));

        } catch(Exception $e) {

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
