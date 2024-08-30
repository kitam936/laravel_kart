<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiretempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tiretemps')->insert([
            [
            'id' => 1,
            'tiretemp_range' => '0℃ - 10℃',
            'from' => 0,
            'to' => 10
            ],
            [
            'id' => 2,
            'tiretemp_range' => '11℃ - 15℃',
            'from' => 11,
            'to' => 15
            ],
            [
            'id' => 3,
            'tiretemp_range' => '16℃ - 20℃',
            'from' => 16,
            'to' => 20
            ],
            [
            'id' => 4,
            'tiretemp_range' => '21℃ - 25℃',
            'from' => 21,
            'to' => 25
            ],
            [
            'id' => 5,
            'tiretemp_range' => '26℃ - 30℃',
            'from' => 26,
            'to' => 30
            ],
            [
            'id' => 6,
            'tiretemp_range' => '31℃ - 35℃',
            'from' => 31,
            'to' => 35
            ],
            [
            'id' => 7,
            'tiretemp_range' => '36℃ - 40℃',
            'from' => 36,
            'to' => 40
            ],
            [
            'id' => 8,
            'tiretemp_range' => '41℃ - 45℃',
            'from' => 41,
            'to' => 45
            ],
            [
            'id' => 9,
            'tiretemp_range' => '46℃ - 50℃',
            'from' => 46,
            'to' => 50
            ],
            [
            'id' => 10,
            'tiretemp_range' => '51℃ - 55℃',
            'from' => 51,
            'to' => 55
            ],
            [
            'id' => 11,
            'tiretemp_range' => '56℃ - 60℃',
            'from' => 56,
            'to' => 60
            ],
            [
            'id' => 12,
            'tiretemp_range' => '61℃ - ',
            'from' => 61,
            'to' => 100
            ],


    ]);
    }
}
