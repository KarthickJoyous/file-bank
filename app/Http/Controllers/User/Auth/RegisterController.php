<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Requests\User\Auth\UserRegisterRequest;
use App\Models\User;
use Illuminate\View\View;
use DB, Exception;

class RegisterController extends Controller
{   
    /** 
     * To show the register form.
     * @return View
    */
    public function registerForm(): View {

        return view('users.auth.register');
    }

    /** 
     * To register an user to application.
     * @param UserRegisterRequest $request
     * @return RedirectResponse  
    */
    public function register(UserRegisterRequest $request): RedirectResponse {

        try {

            DB::beginTransaction();

            $user = User::Create($request->validated());

            throw_if(!$user, new Exception(__('messages.user.register.register_failed')));

            DB::commit();

            auth('web')->login($user);

            return redirect()->route('user.dashboard')->with('success', __('messages.user.register.register_success'));

        } catch(Exception $e) {

            DB::rollback();

            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
