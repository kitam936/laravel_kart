<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stints')->insert([
            [
            'user_id'=> 1,
            'my_kart_id' => 1,
            'my_tire_id'=>2,
            'my_engine_id'=>2,
            'cir_id'=>1,
            'laps'=>20,
            'best_time'=>34.75,
            'start_date'=>'2024/08/13 10:00',
            ],

            [
            'user_id'=> 1,
            'my_kart_id' => 1,
            'my_tire_id'=>2,
            'my_engine_id'=>2,
            'cir_id'=>1,
            'laps'=>20,
            'best_time'=>34.67,
            'start_date'=>'2024/08/13 09:00',
            ],






    ]);
    }
}
