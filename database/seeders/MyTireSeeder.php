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
            'id' => 11,
            'user_id'=> 11,
            'tire_id' => 1,
            'my_tire_info'=>'山本さんから委譲',
            'purchase_date'=>'2024/06/30',
            ],
            [
            'id' => 10,
            'user_id'=> 11,
            'tire_id' => 1,
            'my_tire_info'=>'New',
            'purchase_date'=>'2023/08/16',
            ],

            [
            'id' => 9,
            'user_id'=> 11,
            'tire_id' => 2,
            'my_tire_info'=>'New',
            'purchase_date'=>'2023/03/11',
            ],
            [
            'id' => 8,
            'user_id'=> 11,
            'tire_id' => 2,
            'my_tire_info'=>'New',
            'purchase_date'=>'2022/09/10',
            ],
            [
            'id' => 7,
            'user_id'=> 11,
            'tire_id' => 2,
            'my_tire_info'=>'New',
            'purchase_date'=>'2022/03/12',
            ],
            [
            'id' => 6,
            'user_id'=> 11,
            'tire_id' => 2,
            'my_tire_info'=>'New',
            'purchase_date'=>'2021/08/19',
            ],
            [
            'id' => 5,
            'user_id'=> 11,
            'tire_id' => 2,
            'my_tire_info'=>'New',
            'purchase_date'=>'2021/03/20',
            ],
            [
            'id' => 4,
            'user_id'=> 11,
            'tire_id' => 2,
            'my_tire_info'=>'New',
            'purchase_date'=>'2020/10/24',
            ],
            [
            'id' => 3,
            'user_id'=> 11,
            'tire_id' => 2,
            'my_tire_info'=>'New',
            'purchase_date'=>'2020/02/24',
            ],

    ]);
    }
}
