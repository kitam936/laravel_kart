<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChMaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ch_maint_categories')->insert([
            [
            'id' => 1,
            'ch_maint_name' => 'フレーム系',
            'ch_maint_category_info' => 'フレーム関係',
            'sort_order' => 1,
            ],
            [
            'id' => 2,
            'ch_maint_name' => '駆動系',
            'ch_maint_category_info' => 'シャフト・スプロケット等',
            'sort_order' => 2,
            ],
            [
            'id' => 3,
            'ch_maint_name' => 'ブレーキ系',
            'ch_maint_category_info' => 'ブレーキ系',
            'sort_order' => 3,
            ],
            [
            'id' => 4,
            'ch_maint_name' => '操作系',
            'ch_maint_category_info' => 'ステアリング等',
            'sort_order' => 4,
            ],
            [
            'id' => 5,
            'ch_maint_name' => 'ホイール系',
            'ch_maint_category_info' => 'ホイール・ハブ等',
            'sort_order' => 5,
            ],
            [
            'id' => 6,
            'ch_maint_name' => '外装系',
            'ch_maint_category_info' => 'カウル等',
            'sort_order' => 6,
            ],
            [
            'id' => 7,
            'ch_maint_name' => 'その他メンテナンス',
            'ch_maint_category_info' => 'その他メンテナンス',
            'sort_order' => 7,
            ],
        ]);
    }
}
