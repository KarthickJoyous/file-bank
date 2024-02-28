<?php

namespace App\Http\Controllers\User\Account;

use App\Helpers\Helper;
use Exception;
use Illuminate\Http\{RedirectResponse};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Account\{UserUpdateProfileRequest};

class UserProfileController extends Controller
{
    /**
     * To show the profile details with actions (Edit Profile / Settings / Change Password / Delete Account) form.
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
}
