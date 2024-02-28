<?php

namespace App\Http\Controllers\Admin\Account;

use App\Helpers\Helper;
use Exception;
use Illuminate\Http\{RedirectResponse};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\{AdminUpdateProfileRequest};

class AdminProfileController extends Controller
{
    /**
     * To show the profile details with actions (Edit Profile / Settings / Change Password) form.
    */
    public function profile()
    {
        return view('admins.account.profile');
    }

    /**
     * To update the admin profile details.
     * 
     * @param AdminUpdateProfileRequest $request
     * 
     * @return RedirectResponse
    */
    public function update_profile(AdminUpdateProfileRequest $request): RedirectResponse
    {
        try {

            $admin = auth('admin')->user();

            DB::beginTransaction();

            $result = $admin->update($request->validated());

            throw_if(!$result, new Exception(__('messages.admin.profile.updation_failed')));

            if($request->file('avatar')) {

            Helper::delete_file($admin->avatar, ADMIN_FILE_PATH);

                $result = $admin->update([
                    'avatar' => Helper::upload_file($request->file('avatar'), ADMIN_FILE_PATH)
                ]);

                throw_if(!$result, new Exception(__('messages.admin.profile.avatar_updation_failed')));
            }

            DB::commit();

            return redirect()->back()->with('success', __('messages.admin.profile.updation_success'));

        } catch(Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
