<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyEngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('my_engines')->insert([
            [
            'id' => 11,
            'user_id'=> 11,
            'engine_id' => 1,
            'my_engine_info'=>'New',
            'purchase_date'=>'2020/02/20',
            ],
            [
            'id' => 10,
            'user_id'=> 11,
            'engine_id' => 2,
            'my_engine_info'=>'old',
            'purchase_date'=>'2006/04/20',
            ],
            // [
            // 'id' => 4,
            // 'user_id'=> 2,
            // 'engine_id' => 1,
            // 'my_engine_info'=>'old',
            // 'purchase_date'=>'2016/02/20',
            // ],
            // ['id' => 5,
            // 'user_id'=> 3,
            // 'engine_id' => 2,
            // 'my_engine_info'=>'old',
            // 'purchase_date'=>'2015/02/20',
            // ],

    ]);
    }
}
