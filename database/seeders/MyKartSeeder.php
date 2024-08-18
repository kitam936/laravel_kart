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

    ]);
    }
}
