<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EgMaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eg_maint_categories')->insert([
            [
            'id' => 1,
            'eg_maint_name' => 'フルOH',
            'eg_maint_category_info' => '上周り＆下周り＆キャブOH',
            'sort_order' => 1,
            ],
            [
            'id' => 2,
            'eg_maint_name' => '上周りOH',
            'eg_maint_category_info' => '上周り＆キャブOH',
            'sort_order' => 2,
            ],
            [
            'id' => 3,
            'eg_maint_name' => '点火系',
            'eg_maint_category_info' => 'プラグ他',
            'sort_order' => 3,
            ],
            [
            'id' => 4,
            'eg_maint_name' => 'その他メンテナンス',
            'eg_maint_category_info' => 'その他メンテナンス',
            'sort_order' => 4,
            ],
        ]);
    }
}
