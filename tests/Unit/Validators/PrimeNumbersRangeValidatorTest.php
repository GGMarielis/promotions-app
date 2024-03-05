<?php

namespace Tests\Unit\Validators;

use App\Validators\PrimeNumbersRangeValidator;
use Tests\TestCase;


class PrimeNumbersRangeValidatorTest extends TestCase
{
    public static function inputProvider(): array
    {
        return [
            'bothPositive' => [1, 100, true],
            'initialNegative' => [-1, 100, false],
            'finalNegative' => [1, -100, false],
            'bothNegative' => [-10, -1, false],
            'initialLetter' => ['a', 100, false],
            'finalLetter' => [1, 'b', false],
            'bothLetters' => ['a', 'b', false],
            'bothNull' => [null, null, true],
            'initialNull' => [null, 100, false],
            'finalNull' => [1, null, true],
        ];
    }

    /**
     * @dataProvider inputProvider
     */
    public function testGivenVariousTypesOfInputShouldCorrectlyValidated($initial, $final, $expectedResult)
    {
        $validator = PrimeNumbersRangeValidator::validate($initial, $final);

        $this->assertEquals($expectedResult, !$validator->fails());
    }
}
