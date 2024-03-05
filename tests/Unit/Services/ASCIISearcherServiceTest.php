<?php

namespace Tests\Unit\Services;

use App\Services\ASCIISearcherService;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class ASCIISearcherServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testWhenCallSearchMethodShouldReturnMissingCharacterCorrectly()
    {
        $asciiSearcherService = $this->createPartialMock(ASCIISearcherService::class, ['getRandomKey']);

        $asciiSearcherService->method('getRandomKey')->willReturn(45);

        $result = $asciiSearcherService->search();

        $this->assertEquals('Y', $result);
    }

    public function testWhenCallSearchMethodShouldReturnBetweenRange()
    {
        $result = (new ASCIISearcherService())->search();
        $this->assertGreaterThanOrEqual(ASCIISearcherService::DEFAULT_INITIAL_CHARACTER, ord($result));
        $this->assertLessThanOrEqual(ASCIISearcherService::DEFAULT_FINAL_CHARACTER, ord($result));
    }
}
