<?php

namespace App\Actions\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\{TfaVerificationCode};

class TwoFactoryAuthentication {

    public function handle($user) {

        $user->update(['tfa_verified' => false]);

        Mail::to($user)->send(new TfaVerificationCode($user));

        $message = __('messages.user.tfa_login.verification_code_send');

        $data = [
            '__token' => encrypt([
                'unique_id' => $user->unique_id,
                'email' => $user->email,
                'tfa_status' => ENABLED,
                'timestamp' => now()->addMinute(1)->format('Y-m-d h:i A e')
            ])
        ];

        if(request()->is('api/*')) {
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'code' => 200,
                'data' => $data
            ], 200);
        }

        return redirect()->route('user.tfaLoginForm', $data + ['remember_me' => request('remember_me')])->with('success', $message);
    }
}