<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 */
class TVSeries extends Model
{
    use HasFactory;

    protected $table = 'tv_series';

    public function intervals(): HasMany
    {
        return $this->hasMany(TVSeriesInterval::class, 'id_tv_series');
    }
}
