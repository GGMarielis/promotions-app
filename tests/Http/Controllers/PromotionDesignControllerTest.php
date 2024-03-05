<?php

namespace Tests\Http\Controllers;


use App\Http\Controllers\PromotionDesignController;
use Exads\ABTestException;
use Tests\TestCase;

class PromotionDesignControllerTest extends TestCase
{
    public function testGivenACorrectPromotionShouldReturnARedirectUrl()
    {
        $response = $this->json('GET', '/api/promotions/design/redirect/1');
        $this->assertStringContainsString('\/promotion\/main\/', $response->content());
    }

    public function testGivenANonExistentPromotionShouldThrowAnException()
    {
        $this->expectException(ABTestException::class);
        (new PromotionDesignController())->getRedirectUrl(123);
    }
}
