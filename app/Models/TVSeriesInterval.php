<?php

namespace App\Models;

use App\Enums\WeekDayEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TVSeriesInterval extends Model
{
    use HasFactory;

    protected $table = 'tv_series_intervals';

    protected $primaryKey = 'id_tv_series';

    protected $casts = [
        'week_day' => WeekDayEnum::class,
    ];

    public function series(): BelongsTo
    {
        return $this->belongsTo(TVSeries::class, 'id_tv_series');
    }
}
