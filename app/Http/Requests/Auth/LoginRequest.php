<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'login' => ['required_without:email', 'string', 'max:254', 'nullable'],
            'email' => ['required_without:login', 'email', 'max:254', 'nullable'],
            'password' => ['required', 'string', 'max:254']
        ];
    }
}
