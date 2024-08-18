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
            'tire_name' => 'SL22',
            'tire_info' => 'SL22',
            'sort_order' => 1
            ],
            [
            'id' => 2,
            'tire_name' => 'SL17',
            'tire_info' => 'SL17',
            'sort_order' => 2
            ],
            [
            'id' => 3,
            'tire_name' => 'Mojo',
            'tire_info' => 'Mojo',
            'sort_order' => 3
            ],
    ]);
    }
}
