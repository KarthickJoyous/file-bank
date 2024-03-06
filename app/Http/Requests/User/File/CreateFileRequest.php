<?php

namespace App\Http\Requests\User\File;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class CreateFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'min:1', 'max:25', 'exclude'],
            'folder_id' => ['nullable', 'exists:folders,id,user_id,'.auth('web')->id()],
            'file' => ['required', 'array', 'exclude']
        ];
    }

    /**
     * Prepare the validated data from the request.
     *
     * @return array
     */
    public function validated($key = null, $value = null) {

        return array_merge(parent::validated() + [
            'user_id' => auth('web')->id()
        ]);
    }
}
