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
            'id' => 1,
            'user_id'=> 1,
            'maker_id' => 1,
            'my_kart_info'=>'New',
            'purchase_date'=>'2020/02/20',
            ],
            [
            'id' => 2,
            'user_id'=> 1,
            'maker_id' => 2,
            'my_kart_info'=>'New2',
            'purchase_date'=>'2021/02/20',
            ],
            ['id' => 4,
            'user_id'=> 2,
            'maker_id' => 3,
            'my_kart_info'=>'New2',
            'purchase_date'=>'2021/02/20',
            ],
            ['id' => 5,
            'user_id'=> 3,
            'maker_id' => 2,
            'my_kart_info'=>'New2',
            'purchase_date'=>'2020/02/20',
            ],

    ]);
    }
}
