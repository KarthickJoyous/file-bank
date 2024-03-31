<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{JsonResponse};
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Auth\UserLoginRequest;
use App\Actions\User\{EmailVerification, TwoFactoryAuthentication};

class LoginController extends Controller
{
    /** 
     * To register an user to application.
     * @param UserLoginRequest $request
     * @return JsonResponse  
    */
    public function __invoke(UserLoginRequest $request): JsonResponse {

        try {

            $user = User::firstWhere(['email' => $request->email]);

            throw_if(!Hash::check($request->password, $user->password), new Exception(__('messages.user.login.invalid_credentials'), 422));

            DB::transaction(function() use($user) {
                $result = $user->update([
                    'timezone' => request('timezone', $user->timezone)
                ]);

                throw_if(!$result, new Exception(__('messages.user.login.something_went_wrong'), 500));
            });

            if(!$user->email_status || !$user->email_verified_at) {

                return (new EmailVerification)->handle($user);
            }

            if($user->tfa_status) {

                return (new TwoFactoryAuthentication)->handle($user);
            }

            return $this->success(__('messages.user.login.login_success'), [
                'token' => $user->createToken('api')->plainTextToken,
                'user' => new UserResource($user)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
