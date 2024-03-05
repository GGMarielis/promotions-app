<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TvSeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tv_series')->insert([
            ['title' => 'Game of Thrones', 'channel' => 'HBO', 'gender' => 'Fantasy'],
            ['title' => 'Stranger Things', 'channel' => 'Netflix', 'gender' => 'Horror'],
            ['title' => 'Breaking Bad', 'channel' => 'AMC', 'gender' => 'Drama'],
            ['title' => 'House of The Dragon', 'channel' => 'HBO', 'gender' => 'Fantasy'],
        ]);
    }
}
