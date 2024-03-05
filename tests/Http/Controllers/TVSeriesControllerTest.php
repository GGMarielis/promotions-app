<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\TVSeriesController;
use App\Services\TVSeriesScheduleService;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;

class TVSeriesControllerTest extends TestCase
{
    public function testGivenAExistsTitleShouldReturnSeriesInformation()
    {
        $mockService = Mockery::mock(TVSeriesScheduleService::class);
        $mockService->shouldReceive('getNextAirTime')
            ->once()
            ->withArgs(['Some Series Title', null])
            ->andReturn(['week_day' => 'Friday', 'show_time' => '20:00:00']);


        $controller = new TVSeriesController($mockService);

        $request = new Request();
        $request->merge(['title' => 'Some Series Title']);

        $response = $controller->nextAirTime($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['data' => ['week_day' => 'Friday', 'show_time' => '20:00:00']], $response->getData(true));
    }

    public function testGivenANonExistsTitleShouldReturnNotFoundMessage()
    {
        $mockService = Mockery::mock(TVSeriesScheduleService::class);

        $mockService->shouldReceive('getNextAirTime')
            ->once()
            ->andReturn(null);

        $controller = new TVSeriesController($mockService);


        $request = new Request();
        $request->merge(['title' => 'Non-Existent Series']);

        $response = $controller->nextAirTime($request);

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertEquals(['message' => TVSeriesController::NOT_FOUND_SERIES_MESSAGE], $response->getData(true));
    }
}
