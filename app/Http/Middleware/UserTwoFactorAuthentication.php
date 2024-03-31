<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserTwoFactorAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        try {

            throw_if(!$decrypt = decrypt($request->__token), new Exception); // Decrypt will retrun user email, unique_id & timestamp if success (Check User\LoginController::login())

            throw_if($decrypt['timestamp'] != now()->addMinute(1)->format('Y-m-d h:i A e'), new Exception);

            unset($decrypt['timestamp']);

            throw_if(!$user = User::firstWhere($decrypt), new Exception);

            $request->attributes->add(['user' => $user]);

            return $next($request);

        } catch(Exception $e) {

            $message = __('messages.user.tfa_login.forbidden');

            if($request->is('api/*')) {

                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'code' => 401
                ], 401);
            }

            return redirect()->route('user.login')->with('error', $message);
        }
    }
}
