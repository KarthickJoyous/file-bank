<?php

namespace App\Http\Controllers\Admin\Auth;

use Exception;
use App\Models\Admin;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\{RedirectResponse};
use App\Http\Requests\Admin\Auth\AdminLoginRequest;
use App\Actions\Admin\TwoFactoryAuthentication;

class LoginController extends Controller
{   
    /** 
     * To show the login form.
     * @return View
    */
    public function loginForm(): View {

        return view('admins.auth.login');
    }

    /** 
     * To login an admin to application.
     * @param AdminLoginRequest $request
     * @return RedirectResponse  
    */
    public function login(AdminLoginRequest $request) {

        try {

            $admin = Admin::firstWhere(['email' => $request->email]);

            $login = Hash::check($request->password, $admin->password);

            throw_if(!$login, new Exception(__('messages.admin.login.invalid_credentials')));

            if($admin->tfa_status) {

                return (new TwoFactoryAuthentication)->handle($admin);
            }

            Auth::guard('admin')->login($admin, $request->remember_me);

            return redirect()->route('admin.dashboard')->with('success', __('messages.admin.login.login_success'));

        } catch(Exception $e) {

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
