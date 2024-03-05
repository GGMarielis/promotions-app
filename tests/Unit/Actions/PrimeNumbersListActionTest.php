<?php

namespace Tests\Unit\Actions;

use App\Actions\PrimeNumbersListAction;
use App\Services\PrimeNumbersService;
use Illuminate\Http\Request;
use Tests\TestCase;

class PrimeNumbersListActionTest extends TestCase
{
    public function testGivenACorrectInputValuesWhenRunAsControllerShouldReturnCorrectList()
    {

        $request = Request::create('/prime-numbers', 'GET', [
            'initialValue' => 1,
            'finalValue' => 5,
        ]);

        $action = new PrimeNumbersListAction();

        $response = $action->asController($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            '1 [1]',
            '2 [PRIME]',
            '3 [PRIME]',
            '4 [1, 2, 4]',
            '5 [PRIME]',
        ], $response->getData());
    }

    public function testGivenAInvalidInputWhenRunAsControllerShouldReturnErrorMessage()
    {
        $action = new PrimeNumbersListAction();

        $request = Request::create('/prime-numbers', 'GET', [
            'initialValue' => 'invalid',
            'finalValue' => 'invalid',
        ]);

        $response = $action->asController($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([
            'initial'=> ['The initial field must be an integer.'],
            'final' => ['The final field must be an integer.']
        ], $response->getData(true));
    }

    public function testGivenCorrectInputWhenRunAsCommandShouldResultSuccessResponse()
    {
        $this->artisan('app:prime-numbers', [1, 3])->assertSuccessful();
    }


    public function testGivenCorrectInputWhenRunAsCommandShouldReturnErrorMessage()
    {
        $this->artisan('app:prime-numbers', ['initialValue' => 1, 'finalValue' => 'a'])
            ->assertExitCode(1);
    }
}
