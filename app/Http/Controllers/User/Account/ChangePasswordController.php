<?php

namespace App\Http\Controllers\User\Account;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\{RedirectResponse};
use App\Http\Requests\User\Account\{ChangePasswordRequest};

class ChangePasswordController extends Controller
{
    /**
     * To update the user password.
     * 
     * @param ChangePasswordRequest $request
     * 
     * @return RedirectResponse
    */
    public function __invoke(ChangePasswordRequest $request): RedirectResponse
    {
        try {

            $user = auth('web')->user();

            throw_if(!Hash::check($request->current_password, $user->password), 
                new Exception(__('messages.user.profile.password_incorrect'))
            );

            throw_if($request->current_password == $request->password, 
                new Exception(__('messages.user.profile.password_repeat_error'))
            );

            DB::beginTransaction();

            $result = $user->update($request->only('password') + [
                'last_password_reset_at' => now()
            ]);

            throw_if(!$result, new Exception(__('messages.user.profile.change_password_failed')));

            DB::commit();

            auth('web')->logout();
 
            $request->session()->invalidate();
         
            $request->session()->regenerateToken();

            return redirect()
            ->route('user.login')
            ->with('success', __('messages.user.profile.change_password_success'));

        } catch(Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage())->with('password_error', true);
        }
    }
}