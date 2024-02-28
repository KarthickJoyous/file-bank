<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Actions\User\{EmailVerification, TwoFactoryAuthentication};
use Symfony\Component\HttpFoundation\Response;

class UserAppVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $user = auth('web')->user();

        if(!$user->email_status || !$user->email_verified_at) {

            return (new EmailVerification)->handle($user);
        }

        if($user->tfa_status == YES && $user->tfa_verified == false) {

            return (new TwoFactoryAuthentication)->handle($user);
        }

        return $next($request);
    }
}
