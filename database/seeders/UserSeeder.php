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
        DB::table('users')->insert([
        [
            'name' => 'kitam936',
            'email' => 'tk.ar145qv@gmail.com',
            'password' => Hash::make('mito145147'),
            'role_id' => 1,
            'area_id' => 4
        ],
        [
            'name' => 'cf_manager',
            'email' => 'cf_manager@manager.com',
            'password' => Hash::make('password123'),
            'role_id' => 3,
            'area_id' => 3
        ],
        [
            'name' => 'manager',
            'email' => 'manager@manager.com',
            'password' => Hash::make('password123'),
            'role_id' => 5,
            'area_id' => 4
        ],
        [
            'name' => 'staff_menber',
            'email' => 'staff@staff.com',
            'password' => Hash::make('password123'),
            'role_id' => 7,
            'area_id' => 5
        ],
        [
            'name' => 'member1',
            'email' => 'member1@member.com',
            'password' => Hash::make('password123'),
            'role_id' => 9,
            'area_id' => 6
        ],
        [
            'name' => 'member2',
            'email' => 'member2@member.com',
            'password' => Hash::make('password123'),
            'role_id' => 9,
            'area_id' => 6
        ],
        [
            'name' => 'member3',
            'email' => 'member3@member.com',
            'password' => Hash::make('password123'),
            'role_id' => 9,
            'area_id' => 6
        ],
        [
            'name' => 'member4',
            'email' => 'member4@member.com',
            'password' => Hash::make('password123'),
            'role_id' => 9,
            'area_id' => 6
        ],

    ]);
    }
}
