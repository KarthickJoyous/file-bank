<?php

namespace App\Http\Controllers\User\Account;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\Account\DeleteAccountRequest;

class DeleteAccountController extends Controller
{
    /**
     * To delete account.
     * 
     * @param DeleteAccountRequest $request 
     * 
     * @return RedirectResponse
    */
    public function __invoke(DeleteAccountRequest $request): RedirectResponse
    {
        try {

            $user = auth('web')->user();

            throw_if(!Hash::check($request->password, $user->password), 
                new Exception(__('messages.user.profile.password_incorrect'))
            );

            DB::beginTransaction();

            throw_if(!$user->delete(), new Exception(__('messages.user.profile.delete_account_failed')));

            DB::commit();

            return redirect()
            ->route('user.login')
            ->with('success', __('messages.user.profile.delete_account_success'));
            
        } catch(Exception $e) {

            DB::rollback();

            return redirect()->back()->with('error', $e->getMessage())->with('password_error', true);
        }
    }
}
