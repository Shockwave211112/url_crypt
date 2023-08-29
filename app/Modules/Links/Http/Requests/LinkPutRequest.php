<?php

namespace App\Modules\Links\Http\Requests;

use App\Modules\Core\Rules\isNumericArray;
use Illuminate\Foundation\Http\FormRequest;

class LinkPutRequest extends FormRequest
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
            'name'  => ['required', 'string', 'max:254'],
            'description' => ['required', 'string', 'max:254'],
            'origin' => ['required', 'string', 'max:254'],
            'referral' => ['required', 'string', 'max:254'],
            'group_id' => [new isNumericArray(), 'exists:groups,id']
        ];
    }
}
