<?php

namespace App\Http\Controllers\Admin\Account;

use Exception;
use Illuminate\Http\{JsonResponse, Request};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TwoFAController extends Controller
{
    /**
     * To update the admin tfa status (Two factor authentication).
     * 
     * @param Request $request
     * 
     * @return JsonResponse
    */
    public function __invoke(Request $request): JsonResponse {

        try {

            $tfa_status = $request->tfa_status ? ENABLED : DISABLED;

            DB::beginTransaction();

            throw_if(!auth('admin')->user()->update([
                'tfa_status' => $tfa_status,
                'tfa_verified' => $tfa_status
            ]),
                new Exception(__('messages.admin.profile.tfa_status_updation_failed'))
            );

            DB::commit();

            $formatted_status = $tfa_status ? __('messages.admin.common.enabled') : __('messages.admin.common.disabled');

            $response = [
                'success' => true,
                'tfa_status' => $tfa_status,
                'formatted_status' => $formatted_status,
                'message' => __('messages.admin.profile.tfa_status_updated', ['status' => $formatted_status])
            ];

        } catch(Exception $e) {

            DB::rollback();

            $response = [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }

        return response()->json($response, 200);
    }
}
