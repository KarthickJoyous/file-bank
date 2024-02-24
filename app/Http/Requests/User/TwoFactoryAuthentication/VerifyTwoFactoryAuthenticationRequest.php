<?php

namespace App\Http\Requests\User\TwoFactoryAuthentication;

use Illuminate\Foundation\Http\FormRequest;

class VerifyTwoFactoryAuthenticationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'verification_code' => ['required', 'exists:users,verification_code,id,'.request()->get('user')->id]
        ];
    }
}
