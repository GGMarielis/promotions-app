<?php

use App\Enums\WeekDayEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tv_series_intervals', function (Blueprint $table) {
            $table->bigInteger('id_tv_series')->unsigned();
            $table->enum('week_day', array_column(WeekDayEnum::cases(), 'value'));
            $table->time('show_time');
            $table->foreign('id_tv_series')->references('id')->on('tv_series');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_series_intervals');
    }
};
