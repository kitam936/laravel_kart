<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('engines')->insert([
            [
            'id' => 1,
            'engine_name' => 'KT100SEC',
            'engine_info' => 'KT100セル付き',
            'sort_order' => 1
            ],
            [
            'id' => 2,
            'engine_name' => 'KT100',
            'engine_info' => 'KT100ダイレクト',
            'sort_order' => 2
            ],
            [
            'id' => 3,
            'engine_name' => 'MAX',
            'engine_info' => 'MAX',
            'sort_order' => 3
            ],
    ]);

    }
}
