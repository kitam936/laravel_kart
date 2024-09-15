<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EgMaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eg_maints')->insert([
            [
            'id' => 1,
            'user_id' => 1,
            'my_engine_id' =>1,
            'eg_maint_category_id'=>1,
            'maint_date' => '2023/6/1',
            ],
            [
            'id' => 2,
            'user_id' => 1,
            'my_engine_id' =>1,
            'eg_maint_category_id'=>2,
            'maint_date' => '2022/6/1',
            ],
            [
            'id' => 3,
            'user_id' => 1,
            'my_engine_id' =>2,
            'eg_maint_category_id'=>3,
            'maint_date' => '2021/4/1',
            ],

        ]);
    }
}
