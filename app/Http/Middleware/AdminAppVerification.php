<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Actions\Admin\{TwoFactoryAuthentication};
use Symfony\Component\HttpFoundation\Response;

class AdminAppVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = auth('admin')->user();

        if($admin->tfa_status == YES && $admin->tfa_verified == false) {

            return (new TwoFactoryAuthentication)->handle($admin);
        }

        return $next($request);
    }
}
