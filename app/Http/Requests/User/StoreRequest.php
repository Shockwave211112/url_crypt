<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'login'  => ['required','string','max:254', 'unique:users'],
            'email' => ['required', 'email', 'max:254', 'unique:users'],
            'password' => ['required', 'string', 'max:254'],
            'first_name' => ['required', 'string', 'max:254'],
            'last_name' => ['required', 'string', 'max:254'],
            'role_id' => ['required', 'digits:1', 'max:254', 'exists:roles,id'],
        ];
    }
}
