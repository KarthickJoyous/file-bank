<?php

namespace App\Actions\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationCode;

class EmailVerification {

    public function handle($user) {

        Mail::to($user)->send(new EmailVerificationCode($user));

        $type = url()->previous() == route('user.register') ? 'success' : 'error';

        $message = url()->previous() == route('user.register')
        ? __('messages.user.register.register_success')
        : __('messages.user.email_verification.verificaion_pending_note');

        return redirect()->route('user.verifyEmailForm')->with($type, $message);
    }
}