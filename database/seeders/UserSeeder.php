<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('users')->insert([[
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),
            // 'role_id' => 1,
            // 'area_id' => 3
        ],
        [
            'name' => 'cf_manager',
            'email' => 'cf_manager@manager.com',
            'password' => Hash::make('password123'),
            // 'role_id' => 3,
            // 'area_id' => 3
        ],
        [
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'password' => Hash::make('password123'),
            // 'role_id' => 5,
            // 'area_id' => 4
        ],

    ]);
    }
}
