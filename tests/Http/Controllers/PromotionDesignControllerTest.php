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
        $response = $this->json('GET', '/api/promotions/design/redirect/123');
        $this->assertEquals(422, $response->status());
    }
}
