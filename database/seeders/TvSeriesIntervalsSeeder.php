<?php

namespace Database\Seeders;

use App\Enums\WeekDayEnum;
use App\Models\TVSeries;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TvSeriesIntervalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tvSeries = TVSeries::all();

        $intervals = [];
        $tvSeriesToday = $tvSeries[0];

        $intervals[] = [
            'id_tv_series'  => $tvSeriesToday->id,
            'week_day'  => strtoupper(Carbon::now()->format('l')),
            'show_time'  => Carbon::now()->addHour()->toTimeString(),
        ];

        unset($tvSeries[0]);

        foreach ($tvSeries as $tvShow) {
            $weekDays = array_column(WeekDayEnum::cases(), 'value');
            $randomDay = $weekDays[array_rand($weekDays)];

            $intervals[] = [
              'id_tv_series'  => $tvShow->id,
              'week_day'  => $randomDay,
              'show_time'  => Carbon::now()->addHours(rand(1, 10))->toTimeString(),
            ];
        }
        DB::table('tv_series_intervals')->insert($intervals);
    }
}
