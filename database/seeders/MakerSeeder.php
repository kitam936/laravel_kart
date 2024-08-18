<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('makers')->insert([
            [
            'id' => 1,
            'maker_name' => 'Tony',
            'maker_info' => 'Tony,Cosmic,LN,...etc',
            'sort_order' => 1
            ],
            [
            'id' => 2,
            'maker_name' => 'Birel',
            'maker_info' => 'Birel',
            'sort_order' => 2
            ],
            [
            'id' => 3,
            'maker_name' => 'CRG',
            'maker_info' => 'CRG',
            'sort_order' => 3
            ],
    ]);

    }
}
