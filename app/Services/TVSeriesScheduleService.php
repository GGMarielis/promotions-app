<?php

namespace App\Services;

use App\Enums\WeekDayEnum;
use App\Models\TVSeriesInterval;
use Carbon\Carbon;

class TVSeriesScheduleService
{
    public function getNextAirTime(?string $title = null, ?string $inputDateTime = null): ?array
    {
        $now = $inputDateTime ? Carbon::parse($inputDateTime) : Carbon::now();

        $query = TVSeriesInterval::query()
            ->with('series')
            ->when($title, function ($query, $title) {
                $query->whereHas('series', function ($query) use ($title) {
                    $query->where('title', $title);
                });
            })
            ->where('week_day', WeekDayEnum::from(strtoupper($now->format('l'))))
            ->where('show_time', '>', $now->format('H:i:s'))
            ->orderBy('show_time')
            ->first();

        return $query ? [
            'tile' => $query->series->title,
            'week_day' => $query->week_day->value,
            'show_time' => $query->show_time,
        ] : null;
    }
}
