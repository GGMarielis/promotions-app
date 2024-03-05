<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator as MakerValidator;
use \Illuminate\Validation\Validator;

class PrimeNumbersRangeValidator
{
    const RULES = [
        'initial' => 'nullable|integer|min:1',
        'final' => 'nullable|integer|gte:initial',
    ];

    const MESSAGES = [
        'initial.min' => 'The initial value must be at least 1.',
        'final.gte' => 'The final value must be greater than or equal to the initial value.',
    ];

    public static function validate($initial, $final): Validator
    {
        $data = [
            'initial' => $initial,
            'final' => $final,
        ];

        return MakerValidator::make($data, self::RULES, self::MESSAGES);
    }
}
