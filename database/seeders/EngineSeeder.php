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
            'engine_maker_name'=> 'YAMAHA',
            'engine_name' => 'KT100SEC',
            'engine_info' => 'KT100セル付き',
            'sort_order' => 1
            ],
            [
            'id' => 2,
            'engine_maker_name'=> 'YAMAHA',
            'engine_name' => 'KT100',
            'engine_info' => 'KT100ダイレクト',
            'sort_order' => 2
            ],
            [
            'id' => 3,
            'engine_maker_name'=> 'ROTAX',
            'engine_name' => 'MAX',
            'engine_info' => '水冷125cc',
            'sort_order' => 3
            ],
            [
            'id' => 4,
            'engine_maker_name'=> 'VORTEX',
            'engine_name' => 'VORTEX',
            'engine_info' => 'VORTEX',
            'sort_order' => 4
            ],
            [
            'id' => 5,
            'engine_maker_name'=> 'IAME',
            'engine_name' => 'X30',
            'engine_info' => '水冷125cc',
            'sort_order' => 5
            ],
            [
            'id' => 99,
            'engine_maker_name'=> 'Others',
            'engine_name' => 'Others',
            'engine_info' => 'その他',
            'sort_order' => 99
            ],
    ]);

    }
}
