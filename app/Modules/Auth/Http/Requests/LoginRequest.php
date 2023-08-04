<?php

namespace App\Modules\Auth\Http\Requests;

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
            'name' => ['required_without:email', 'string', 'max:254', 'nullable'],
            'email' => ['required_without:name', 'email', 'max:254', 'nullable'],
            'password' => ['required', 'string', 'max:254']
        ];
    }
}
