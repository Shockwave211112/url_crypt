<?php

namespace App\Modules\Core\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class isNumericArray implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            $fail('The :attribute must be valid numeric array.');
        } else {
            foreach ($value as $item) {
                if (!is_numeric($item)) {
                    $fail('The :attribute must be valid numeric value.');
                }
            }
        }
    }
}
