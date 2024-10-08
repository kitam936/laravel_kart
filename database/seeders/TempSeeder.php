<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('temps')->insert([
            [
            'id' => 1,
            'temp_range' => '0℃ - 10℃',
            'from' => 0,
            'to' => 10
            ],
            [
            'id' => 2,
            'temp_range' => '11℃ - 15℃',
            'from' => 11,
            'to' => 15
            ],
            [
            'id' => 3,
            'temp_range' => '16℃ - 20℃',
            'from' => 16,
            'to' => 20
            ],
            [
            'id' => 4,
            'temp_range' => '21℃ - 25℃',
            'from' => 21,
            'to' => 25
            ],
            [
            'id' => 5,
            'temp_range' => '26℃ - 30℃',
            'from' => 26,
            'to' => 30
            ],
            [
            'id' => 6,
            'temp_range' => '31℃ - 35℃',
            'from' => 31,
            'to' => 35
            ],
            [
            'id' => 7,
            'temp_range' => '36℃ - 40℃',
            'from' => 36,
            'to' => 40
            ],
            [
            'id' => 8,
            'temp_range' => '41℃ - 45℃',
            'from' => 41,
            'to' => 45
            ],
            [
            'id' => 99,
            'temp_range' => '',
            'from' => 41,
            'to' => 45
            ],

    ]);
    }
}
