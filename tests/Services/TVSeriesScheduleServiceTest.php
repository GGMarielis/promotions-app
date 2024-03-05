<?php

namespace Tests\Services;

use App\Enums\WeekDayEnum;
use App\Models\TVSeries;
use App\Models\TVSeriesInterval;
use App\Services\TVSeriesScheduleService;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TVSeriesScheduleServiceTest extends TestCase
{
    use RefreshDatabase;

    protected TVSeriesScheduleService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new TVSeriesScheduleService();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public static function getNextAirTimeDataProvider(): array
    {
        $timeNow = Carbon::now();
        $timeOneHourLater = $timeNow->copy()->addHour();
        $timeFormatted = $timeNow->format('Y-m-d H:i:s');
        $timeOneHourLaterFormatted = $timeOneHourLater->format('H:i:s');
        $weekDayUpper = strtoupper($timeOneHourLater->format('l'));

        return [
            [null, null, $weekDayUpper, $timeOneHourLaterFormatted],
            ['Some Series Title', $timeFormatted, $weekDayUpper, $timeOneHourLaterFormatted],
            [null, $timeFormatted, $weekDayUpper, $timeOneHourLaterFormatted],
            ['Some Series Title', null, $weekDayUpper, $timeOneHourLaterFormatted],
        ];
    }

    /**
     * @dataProvider getNextAirTimeDataProvider
     */
    public function testWhenMakeACallToGetSeriesShouldReturnTheCorrectSeries(?string $title, ?string $inputDateTime, string $expectedWeekDay, string $expectedShowTime)
    {
        $tvSeries = TVSeries::factory()->createOne(['title' => 'Some Series Title']);
        TVSeriesInterval::factory()->createOne([
            'id_tv_series' => $tvSeries->id,
            'week_day' => $expectedWeekDay,
            'show_time' => $expectedShowTime
        ]);

        $result = $this->service->getNextAirTime($title, $inputDateTime);

        $this->assertNotNull($result);
        $this->assertEquals($expectedWeekDay, $result['week_day']);
        $this->assertEquals($expectedShowTime, $result['show_time']);
    }

    public function testWhenMakeACallToGetSeriesShouldReturnNullIfSeriesDoesNotExists()
    {
        $tvSeries = TVSeries::factory()->createOne(['title' => 'Some Series Title']);
        TVSeriesInterval::factory()->createOne([
            'id_tv_series' => $tvSeries->id,
            'week_day' => WeekDayEnum::TUESDAY,
            'show_time' => '21:00:00'
        ]);

        $result = $this->service->getNextAirTime('Some Series Title II');

        $this->assertNull($result);
    }
}
