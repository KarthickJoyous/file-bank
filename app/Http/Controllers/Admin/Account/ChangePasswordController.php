<?php

namespace App\Http\Controllers\Admin\Account;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\{RedirectResponse};
use App\Mail\Admin\ChangePassswordSuccess;
use App\Http\Requests\Admin\Account\{ChangePasswordRequest};

class ChangePasswordController extends Controller
{
    /**
     * To update the admin password.
     * 
     * @param ChangePasswordRequest $request
     * 
     * @return RedirectResponse
    */
    public function __invoke(ChangePasswordRequest $request): RedirectResponse
    {
        try {

            $admin = auth('admin')->user();

            throw_if(!Hash::check($request->current_password, $admin->password), 
                new Exception(__('messages.admin.profile.password_incorrect'))
            );

            throw_if($request->current_password == $request->password, 
                new Exception(__('messages.admin.profile.password_repeat_error'))
            );

            DB::beginTransaction();

            $result = $admin->update($request->only('password') + [
                'last_password_reset_at' => now()
            ]);

            throw_if(!$result, new Exception(__('messages.admin.profile.change_password_failed')));

            DB::commit();

            Mail::to($admin)->send(new ChangePassswordSuccess($admin));

            auth('admin')->logout();
 
            $request->session()->invalidate();
         
            $request->session()->regenerateToken();

            return redirect()
            ->route('admin.login')
            ->with('success', __('messages.admin.profile.change_password_success'));

        } catch(Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage())->with('password_error', true);
        }
    }
}