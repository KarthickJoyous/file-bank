<?php

namespace App\Actions\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\{TfaVerificationCode};

class TwoFactoryAuthentication {

    public function handle($admin) {

        $admin->update(['tfa_verified' => false]);

        Mail::to($admin)->send(new TfaVerificationCode($admin));

        return redirect()->route('admin.tfaLoginForm', [
            '__token' => encrypt([
                'unique_id' => $admin->unique_id,
                'email' => $admin->email,
                'tfa_status' => ENABLED,
                'timestamp' => now()->addMinute(1)->format('Y-m-d h:i A e')
            ]),
            'remember_me' => request('remember_me')
        ])->with('success', __('messages.admin.tfa_login.verification_code_send'));
    }
}