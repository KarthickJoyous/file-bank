<?php

namespace App\Http\Controllers\Api\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\EmailVerificationCode;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\Api\Auth\UserRegisterRequest;

class RegisterController extends Controller
{   
    /** 
     * To register an user to application.
     * @param UserRegisterRequest $request
     * @return JsonResponse  
    */
    public function __invoke(UserRegisterRequest $request): JsonResponse {

        try {

            $user = DB::transaction(function() use($request) {

                $user = User::Create($request->validated());

                throw_if(!$user, new Exception(__('messages.user.register.register_failed'), 500));

                return $user->refresh();
            });

            Mail::to($user)->send(new EmailVerificationCode($user));

            return $this->success(__('messages.user.register.register_success'), [
                'token' => $user->createToken('api')->plainTextToken,
                'user' => new UserResource($user)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
