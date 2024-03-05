<?php


namespace Tests\Unit\Services;

use App\Services\PrimeNumbersService;
use Tests\TestCase;

class PrimeNumbersServiceTest extends TestCase
{
    private PrimeNumbersService $primeNumbersService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->primeNumbersService = new PrimeNumbersService();
    }

    public function testWithBothValuesProvided()
    {
        $result = $this->primeNumbersService->listPrimeNumbers(1, 10);
        $expected = [
            "1 [1]",
            "2 [PRIME]",
            "3 [PRIME]",
            "4 [1, 2, 4]",
            "5 [PRIME]",
            "6 [1, 2, 3, 6]",
            "7 [PRIME]",
            "8 [1, 2, 4, 8]",
            "9 [1, 3, 9]",
            "10 [1, 2, 5, 10]",
        ];
        $this->assertEquals($expected, $result);
    }

    public function testWithInitialValueNull()
    {
        $result = $this->primeNumbersService->listPrimeNumbers(null, 2);
        $expected = [
            "1 [1]",
            "2 [PRIME]",
        ];
        $this->assertEquals($expected, $result);
    }

    public function testWhenFinalValueIsNullShouldSetFinalValueToOneHundred()
    {
        $result = $this->primeNumbersService->listPrimeNumbers(1, null);
        $this->assertNotEmpty($result);
        $this->assertCount(100, $result);
    }

    public function testWhenBothValuesAreNullTheRangeShouldBeFromOneToOneHundred()
    {
        $result = $this->primeNumbersService->listPrimeNumbers(null, null);
        $this->assertNotEmpty($result);
        $this->assertCount(100, $result);
        $this->assertEquals("1 [1]", $result[0]);
    }

    public function testWhenReturnAListShouldHaveTheCorrectFormat()
    {
        $service = new PrimeNumbersService();
        $initValue = 1;
        $finalValue = 10;

        $result = $service->listPrimeNumbers($initValue, $finalValue);

        $this->assertEquals("9 [1, 3, 9]", $result[8]);
        $this->assertEquals("3 [PRIME]", $result[2]);
    }
}
