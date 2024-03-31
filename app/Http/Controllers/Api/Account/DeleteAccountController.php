<?php

namespace App\Http\Controllers\Api\Account;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Api\Account\DeleteAccountRequest;

class DeleteAccountController extends Controller
{
    /**
     * To delete account.
     * 
     * @param DeleteAccountRequest $request 
     * 
     * @return JsonResponse
    */
    public function __invoke(DeleteAccountRequest $request): JsonResponse
    {
        try {

            $user = $request->user();

            throw_if(!Hash::check($request->password, $user->password), 
                new Exception(__('messages.user.profile.password_incorrect'), 422)
            );

            DB::transaction(function() use($user) {
                throw_if(!$user->delete(), new Exception(__('messages.user.profile.delete_account_failed'), 500));
            });

            return $this->success(__('messages.user.profile.delete_account_success'));
            
        } catch(Exception $e) {
            
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
