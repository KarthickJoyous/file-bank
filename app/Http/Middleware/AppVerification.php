<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationCode;

class AppVerification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if(!auth('web')->user()->email_status || !auth('web')->user()->email_verified_at) {

            $user = auth('web')->user();

            Mail::to($user)->send(new EmailVerificationCode($user));

            $type = url()->previous() == route('user.register') ? 'success' : 'error';

            $message = url()->previous() == route('user.register')
            ? __('messages.user.register.register_success')
            : __('messages.user.email_verification.verificaion_pending_note');

            return redirect()->route('user.verifyEmailForm')->with($type, $message);
        }

        return $next($request);
    }
}
