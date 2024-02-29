<?php

namespace App\Actions\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\{TfaVerificationCode};

class TwoFactoryAuthentication {

    public function handle($user) {

        $user->update(['tfa_verified' => false]);

        Mail::to($user)->send(new TfaVerificationCode($user));

        return redirect()->route('user.tfaLoginForm', [
            '__token' => encrypt([
                'unique_id' => $user->unique_id,
                'email' => $user->email,
                'tfa_status' => ENABLED,
                'timestamp' => now()->addMinute(1)->format('Y-m-d h:i A e')
            ]),
            'remember_me' => request('remember_me')
        ])->with('success', __('messages.user.tfa_login.verification_code_send'));
    }
}