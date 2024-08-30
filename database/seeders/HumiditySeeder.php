<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HumiditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('humidities')->insert([
            [
            'id' => 1,
            'humi_range' => '10% - 20%',
            'from' => 10,
            'to' => 20
            ],
            [
            'id' => 2,
            'humi_range' => '21% - 30%',
            'from' => 21,
            'to' => 30
            ],
            [
            'id' => 3,
            'humi_range' => '31% - 40%',
            'from' => 31,
            'to' => 40
            ],
            [
            'id' => 4,
            'humi_range' => '41% - 50%',
            'from' => 41,
            'to' => 50
            ],
            [
            'id' => 5,
            'humi_range' => '51% - 60%',
            'from' => 51,
            'to' => 60
            ],
            [
            'id' => 6,
            'humi_range' => '61% - 70%',
            'from' => 36,
            'to' => 70
            ],
            [
            'id' => 7,
            'humi_range' => '71% - 80%',
            'from' => 71,
            'to' => 80
            ],
            [
            'id' => 8,
            'humi_range' => '81% - 90%',
            'from' => 81,
            'to' => 90
            ],
            [
            'id' => 9,
            'humi_range' => '91% - 10%0',
            'from' => 91,
            'to' => 100
            ],

    ]);
    }

}
