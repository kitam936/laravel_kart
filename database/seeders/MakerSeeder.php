<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('makers')->insert([
            [
            'id' => 1,
            'maker_name' => 'Tony',
            'maker_info' => 'OTK GROUP',
            'sort_order' => 1
            ],
            [
            'id' => 2,
            'maker_name' => 'KOSMIC',
            'maker_info' => 'OTK GROUP',
            'sort_order' => 2
            ],
            [
            'id' => 3,
            'maker_name' => 'EXPRIT',
            'maker_info' => 'OTK GROUP',
            'sort_order' => 3
            ],
            [
            'id' => 4,
            'maker_name' => 'REDSPEED',
            'maker_info' => 'OTK GROUP',
            'sort_order' => 4
            ],
            [
            'id' => 5,
            'maker_name' => 'LN',
            'maker_info' => 'OTK GROUP',
            'sort_order' => 5
            ],
            [
            'id' => 6,
            'maker_name' => 'Birel',
            'maker_info' => 'Birel GROUP',
            'sort_order' => 6
            ],
            [
            'id' => 7,
            'maker_name' => 'INTREPID',
            'maker_info' => 'INTREPID',
            'sort_order' => 7
            ],
            [
            'id' => 99,
            'maker_name' => 'Others',
            'maker_info' => 'その他',
            'sort_order' => 99
            ],
    ]);

    }
}
