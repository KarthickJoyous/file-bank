<?php

namespace App\Http\Controllers\User\Account;

use App\Helpers\Helper;
use Exception, Hash;
use Illuminate\Http\{Request, RedirectResponse};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Account\{UserUpdateProfileRequest, ChangePasswordRequest};

class UserProfileController extends Controller
{
    /**
     * To show the profile details with actions (Edit Profile / Settings / Change Password) form.
    */
    public function profile()
    {
        return view('users.account.profile');
    }

    /**
     * To update the user profile details.
     * 
     * @param UserUpdateProfileRequest $request
     * 
     * @return RedirectResponse
    */
    public function update_profile(UserUpdateProfileRequest $request): RedirectResponse
    {
        try {

            $user = auth('web')->user();

            DB::beginTransaction();

            $result = $user->update($request->validated());

            throw_if(!$result, new Exception(__('messages.user.profile.updation_failed')));

            if($request->file('avatar')) {

                Helper::delete_file($user->avatar, USER_FILE_PATH);

                $result = $user->update([
                    'avatar' => Helper::upload_file($request->file('avatar'), USER_FILE_PATH)
                ]);

                throw_if(!$result, new Exception(__('messages.user.profile.avatar_updation_failed')));
            }

            DB::commit();

            return redirect()->back()->with('success', __('messages.user.profile.updation_success'));

        } catch(Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * To update the user password.
     * 
     * @param ChangePasswordRequest $request
     * 
     * @return RedirectResponse
    */
    public function change_password(ChangePasswordRequest $request): RedirectResponse {

        try {

            $user = auth('web')->user();

            throw_if(!Hash::check($request->current_password, $user->password), 
                new Exception(__('messages.user.profile.password_incorrect'))
            );

            throw_if($request->current_password == $request->password, 
                new Exception(__('messages.user.profile.password_repeat_error'))
            );

            DB::beginTransaction();

            $result = $user->update($request->only('password'));

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
