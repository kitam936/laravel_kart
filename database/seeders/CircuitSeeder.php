<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CircuitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('circuits')->insert([
            [
            'id' => 1,
            'area_id' =>4,
            'cir_name' => 'フェスティカ栃木',
            'cir_info' => 'フェスティカ栃木',
            'url' => 'https://festika-tochigi.com/',
            'length'=>628
            ],
            [
            'id' => 2,
            'area_id' =>5,
            'cir_name' => 'フェスティカ瑞浪',
            'cir_info' => 'フェスティカ瑞浪',
            'url' => 'https://festika-mizunami.com/',
            'length'=>1177
            ],
            [
            'id' => 3,
            'area_id' =>4,
            'cir_name' => '榛名モータースポーツランド',
            'cir_info' => '榛名モータースポーツランド',
            'url' => 'http://haruna-motor.sports.coocan.jp/',
            'length'=>900
            ],
            [
            'id' => 4,
            'area_id' =>4,
            'cir_name' => '井頭モーターパーク',
            'cir_info' => '井頭モーターパーク',
            'url' => 'https://www.linson.co.jp/',
            'length'=>620
            ],

    ]);
    }
}
