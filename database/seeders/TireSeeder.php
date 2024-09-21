<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tires')->insert([
            [
            'id' => 1,
            'tire_maker_name' => 'DL',
            'tire_name' => 'SL22',
            'tire_info' => 'SL22',
            'sort_order' => 1
            ],
            [
            'id' => 2,
            'tire_maker_name' => 'BS',
            'tire_name' => 'SL17',
            'tire_info' => 'SL17',
            'sort_order' => 2
            ],
            [
            'id' => 3,
            'tire_maker_name' => 'YOKOHAMA',
            'tire_name' => 'SL07',
            'tire_info' => 'SL07',
            'sort_order' => 3
            ],
            [
            'id' => 10,
            'tire_maker_name' => 'DL FD',
            'tire_name' => 'DL FD',
            'tire_info' => 'DL FD',
            'sort_order' => 10
            ],
            [
            'id' => 21,
            'tire_maker_name' => 'DL',
            'tire_name' => 'SL WET',
            'tire_info' => 'SL WET',
            'sort_order' => 21
            ],
            [
            'id' => 31,
            'tire_maker_name' => 'Mojo',
            'tire_name' => 'Mojo',
            'tire_info' => 'Mojo',
            'sort_order' => 31
            ],
            [
            'id' => 99,
            'tire_maker_name' => 'Others',
            'tire_name' => 'Others',
            'tire_info' => 'その他',
            'sort_order' => 99
            ],
    ]);
    }
}
