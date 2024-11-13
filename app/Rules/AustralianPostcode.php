<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Adrnz\PostcodeValidator\Validator;


class AustralianPostcode implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        return Validator::isValid($value, 'AU');
    }

    public function message()
    {
        return 'The :attribute is not a valid Australian postcode.';
    }
}
