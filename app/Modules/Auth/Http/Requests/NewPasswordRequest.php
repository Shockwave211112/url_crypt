<?php

namespace App\Modules\Auth\Http\Requests;

use App\Modules\Core\Rules\isBase64;
use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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
            'password' => ['required', 'string', 'max:254', 'confirmed'],
            'token' => ['required', 'string', new isBase64()],
        ];
    }
}
