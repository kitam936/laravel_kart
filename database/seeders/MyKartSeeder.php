<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyKartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('my_karts')->insert([
            [
            'id' => 11,
            'user_id'=> 11,
            'maker_id' => 1,
            'model_year' => 2020,
            'my_kart_info'=>'新車購入',
            'purchase_date'=>'2020/02/20',
            ],
            [
            'id' => 10,
            'user_id'=> 11,
            'maker_id' => 6,
            'model_year' => 2006,
            'my_kart_info'=>'新車購入',
            'purchase_date'=>'2006/02/20',
            ],
            // ['id' => 4,
            // 'user_id'=> 2,
            // 'maker_id' => 3,
            // 'model_year' => 2021,
            // 'my_kart_info'=>'New2',
            // 'purchase_date'=>'2021/02/20',
            // ],
            // ['id' => 5,
            // 'user_id'=> 3,
            // 'maker_id' => 2,
            // 'model_year' => 2022,
            // 'my_kart_info'=>'New2',
            // 'purchase_date'=>'2022/02/20',
            // ],

    ]);
    }
}
