<?php

namespace App\Http\Requests\User\Folder;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolderRequest extends FormRequest
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
            'name' => ['required', 'min:1', 'max:25'],
            'sub_folder' => ['nullable', 'exists:folders,id,user_id,'.auth('web')->id()],
            'description' => ['nullable', 'min:1', 'max:255']
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
