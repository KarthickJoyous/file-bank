<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Requests\User\Auth\UserLoginRequest;
use App\Models\User;
use Illuminate\View\View;
use DB, Auth, Exception;

class LoginController extends Controller
{   
    /** 
     * To show the login form.
     * @return View
    */
    public function loginForm() {

        return view('users.auth.login');
    }

    /** 
     * To register an user to application.
     * @param UserLoginRequest $request
     * @return RedirectResponse  
    */
    public function login(UserLoginRequest $request) {

        try {

            $login = Auth::guard('web')->attempt($request->only(['email', 'password']), $request->remember_me);

            throw_if(!$login, new Exception(__('messages.user.login.invalid_credentials')));

            return redirect()->route('user.dashboard')->with('success', __('messages.user.login.login_success'));

        } catch(Exception $e) {

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
