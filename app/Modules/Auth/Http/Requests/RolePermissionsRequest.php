<?php

namespace App\Modules\Auth\Http\Requests;

use App\Modules\Auth\Rules\isBase64;
use Illuminate\Foundation\Http\FormRequest;

class RolePermissionsRequest extends FormRequest
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
            'role_id' => ['required', 'integer', 'exists:roles,id'],
            'permissions' => ['required', 'array', 'exists:permissions,id']
        ];
    }
}
