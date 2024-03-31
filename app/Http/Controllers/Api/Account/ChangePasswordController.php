<?php

namespace App\Http\Controllers\Api\Account;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\{JsonResponse};
use App\Mail\User\ChangePassswordSuccess;
use App\Http\Requests\Api\Account\{ChangePasswordRequest};

class ChangePasswordController extends Controller
{
    /**
     * To update the user password.
     * 
     * @param ChangePasswordRequest $request
     * 
     * @return JsonResponse
    */
    public function __invoke(ChangePasswordRequest $request): JsonResponse
    {
        try {

            $user = $request->user();

            throw_if(!Hash::check($request->current_password, $user->password), 
                new Exception(__('messages.user.profile.password_incorrect'), 422)
            );

            throw_if($request->current_password == $request->password, 
                new Exception(__('messages.user.profile.password_repeat_error'), 422)
            );

            $validatd = $request->only('password');

            DB::transaction(function() use($user, $validatd) {

                throw_if(!$user->update($validatd + [
                    'last_password_reset_at' => now()
                ]), new Exception(__('messages.user.profile.change_password_failed'), 500));

                $user->currentAccessToken()->delete();
            });

            Mail::to($user)->send(new ChangePassswordSuccess($user));

            return $this->success(__('messages.user.profile.change_password_success'), [
                'user' => new UserResource($user)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}