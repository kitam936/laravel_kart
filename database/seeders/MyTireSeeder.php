<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MyTireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('my_tires')->insert([
            [
            'id' => 1,
            'user_id'=> 1,
            'tire_id' => 1,
            'my_tire_info'=>'New',
            'purchase_date'=>'2023/08/16',
            ],
            [
            'id' => 2,
            'user_id'=> 1,
            'tire_id' => 1,
            'my_tire_info'=>'山本さんから委譲',
            'purchase_date'=>'2024/06/30',
            ],

    ]);
    }
}
