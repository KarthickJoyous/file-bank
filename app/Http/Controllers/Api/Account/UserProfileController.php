<?php

namespace App\Http\Controllers\Api\Account;

use Exception;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{JsonResponse};
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\Account\{UserUpdateProfileRequest};

class UserProfileController extends Controller
{
    /**
     * To get logged in user details.
     * @param Request $request
     * @return JsonResponse
    */
    public function profile(Request $request): JsonResponse
    {
        return $this->success('', [
            'user' => new UserResource($request->user())
        ]);
    }

    /**
     * To update the user profile details.
     * 
     * @param UserUpdateProfileRequest $request
     * 
     * @return JsonResponse
    */
    public function update_profile(UserUpdateProfileRequest $request): JsonResponse
    {
        try {

            $data['user'] = DB::transaction(function() use($request) {

                $user = $request->user();

                throw_if(!$user->update($request->validated()), new Exception(__('messages.user.profile.updation_failed'), 500));

                if($request->file('avatar')) {

                    Helper::delete_file($user->avatar, USER_FILE_PATH);

                    throw_if(!$user->update([
                        'avatar' => Helper::upload_file($request->file('avatar'), USER_FILE_PATH)
                    ]), new Exception(__('messages.user.profile.avatar_updation_failed')));
                }

                return new UserResource($user->refresh());
            });

            return $this->success(__('messages.user.profile.updation_success'), $data);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
