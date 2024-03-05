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
        foreach ($tvSeries as $tvShow) {
            $weekDays = array_column(WeekDayEnum::cases(), 'value');
            $randomDay = $weekDays[array_rand($weekDays)];

            $intervals[] = [
              'id_tv_series'  => $tvShow->id,
              'week_day'  => $randomDay,
              'show_time'  => Carbon::now()->toTimeString(),
            ];
        }
        DB::table('tv_series_intervals')->insert($intervals);
    }
}
