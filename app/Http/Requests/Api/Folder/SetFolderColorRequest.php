<?php

namespace App\Http\Requests\Api\Folder;

use Illuminate\Foundation\Http\FormRequest;

class SetFolderColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'folder' => ['required', 'regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i', 'max:7']
        ];
    }
}
