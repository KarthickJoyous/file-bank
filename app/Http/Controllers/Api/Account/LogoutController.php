<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};

class LogoutController extends Controller
{
    /**
     * Log the user out of the application.
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success(__('messages.user.logout.logout_success'), []);
    }
}
