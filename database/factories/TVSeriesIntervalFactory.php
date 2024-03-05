<?php

namespace Database\Factories;

use App\Enums\WeekDayEnum;
use App\Models\TVSeries;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TVSeriesInterval>
 */
class TVSeriesIntervalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_tv_series' => TVSeries::factory()->createOne()->id,
            'week_day' => WeekDayEnum::cases(),
            'show_time' => Carbon::now()->format('H:i:s')
        ];
    }
}
