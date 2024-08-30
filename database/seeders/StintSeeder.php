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
            'my_tire_id'=>1,
            'my_engine_id'=>2,
            'cir_id'=>1,
            'laps'=>20,
            'best_time'=>34.75,
            'max_rev' => 14600,
            'min_rev'=> 7700,
            'start_date'=>'2024/08/13 10:00',
            'dry_wet' => 'dry',
            'temp'=> 4,
            'tire_age'=>0,
            'humidity' => 6,
            'road_temp' => 8,
            ],

            [
            'user_id'=> 1,
            'my_kart_id' => 1,
            'my_tire_id'=>1,
            'my_engine_id'=>1,
            'cir_id'=>1,
            'laps'=>20,
            'best_time'=>34.67,
            'max_rev' => 14600,
            'min_rev'=> 7700,
            'start_date'=>'2024/08/13 09:00',
            'dry_wet' => 'dry',
            'temp'=> 5,
            'tire_age'=>20,
            'humidity' => 7,
            'road_temp' => 9,
            ],
            ['user_id'=> 1,
            'my_kart_id' => 2,
            'my_tire_id'=>3,
            'my_engine_id'=>2,
            'cir_id'=>2,
            'laps'=>20,
            'best_time'=>37.67,
            'max_rev' => 14800,
            'min_rev'=> 7900,
            'start_date'=>'2023/08/13 09:00',
            'dry_wet' => 'dry',
            'temp'=> 6,
            'tire_age'=>40,
            'humidity' => 8,
            'road_temp' => 8,
            ],
            ['user_id'=> 1,
            'my_kart_id' => 2,
            'my_tire_id'=>3,
            'my_engine_id'=>2,
            'cir_id'=>3,
            'laps'=>20,
            'best_time'=>38.67,
            'max_rev' => 14800,
            'min_rev'=> 7900,
            'start_date'=>'2023/06/13 09:00',
            'dry_wet' => 'dry',
            'temp'=> 4,
            'tire_age'=>60,
            'humidity' =>6,
            'road_temp' => 6,
            ],
            [
            'user_id'=> 2,
            'my_kart_id' => 4,
            'my_tire_id'=>4,
            'my_engine_id'=>4,
            'cir_id'=>1,
            'laps'=>20,
            'best_time'=>34.75,
            'max_rev' => 14600,
            'min_rev'=> 7700,
            'start_date'=>'2024/07/13 10:00',
            'dry_wet' => 'dry',
            'temp'=> 4,
            'tire_age'=>80,
            'humidity' => 6,
            'road_temp' => 8,
            ],

            [
            'user_id'=> 3,
            'my_kart_id' => 5,
            'my_tire_id'=>5,
            'my_engine_id'=>5,
            'cir_id'=>1,
            'laps'=>20,
            'best_time'=>34.67,
            'max_rev' => 14600,
            'min_rev'=> 7700,
            'start_date'=>'2024/06/13 09:00',
            'dry_wet' => 'dry',
            'temp'=> 5,
            'tire_age'=>100,
            'humidity' => 7,
            'road_temp' => 9,
            ],
    ]);
    }
}
