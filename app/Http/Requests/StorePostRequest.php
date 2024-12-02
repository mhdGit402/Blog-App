<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id'
        ];
    }
    // Optionally, you can customize the error messages
    public function messages()
    {
        return [
            'title.required' => 'The title is required.',
            'tag.required' => 'The tag is required.',
            'description.required' => 'The description is required.',
            'user_id.required' => 'You need to log in.',
        ];
    }
}
