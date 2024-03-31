<?php

namespace App\Http\Controllers\Api\Account;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\{JsonResponse, Request};

class TwoFAController extends Controller
{
    /**
     * To update the user tfa status (Two factor authentication).
     * 
     * @param Request $request
     * 
     * @return JsonResponse
    */
    public function __invoke(Request $request): JsonResponse {

        try {

            $user = $request->user();

            $tfa_status = $user->tfa_status ? DISABLED : ENABLED;

            DB::transaction(function() use($user, $tfa_status) {

                throw_if(!$user->update([
                    'tfa_status' => $tfa_status,
                    'tfa_verified' => $tfa_status
                ]),
                    new Exception(__('messages.user.profile.tfa_status_updation_failed'), 500)
                );
            });

            $formatted_status = $tfa_status ? __('messages.user.common.enabled') : __('messages.user.common.disabled');

            return $this->success(__('messages.user.profile.tfa_status_updated', ['status' => $formatted_status]), [
                'user' => new UserResource($user)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
