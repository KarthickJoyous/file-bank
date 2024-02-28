<?php

namespace App\Http\Requests\Admin\Account;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class AdminUpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the admin is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', Rule::unique('admins')->ignore(auth('admin')->id()), 'max:50'],
            'mobile' => ['nullable', 'digits_between:10,13'],
            'about' => ['nullable', 'min:5', 'max:255'],
            'avatar' => ['nullable', 'file', 'mimes:jpg,jpeg,png', 'exclude']
        ];
    }
}
