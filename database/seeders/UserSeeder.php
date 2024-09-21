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
            'id' => 11,
            'name' => 'kitam936',
            'email' => 'tk.ar145qv@gmail.com',
            'password' => Hash::make('mito145147'),
            'role_id' => 1,
            'area_id' => 4
        ],
        [
            'id' => 1,
            'name' => 'admin_ktm',
            'email' => 'toshiharu_k147@eos.ocn.ne.jp',
            'password' => Hash::make('mito145147'),
            'role_id' => 1,
            'area_id' => 4
        ],
        [
            'id' => 2,
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => Hash::make('password123'),
            'role_id' => 5,
            'area_id' => 4
        ],
        [
            'id' => 3,
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => Hash::make('password123'),
            'role_id' => 7,
            'area_id' => 5
        ],
        [
            'id' => 4,
            'name' => 'test6',
            'email' => 'test6@test.com',
            'password' => Hash::make('password123'),
            'role_id' => 9,
            'area_id' => 6
        ],
        [
            'id' => 5,
            'name' => 'test3',
            'email' => 'test3@test.com',
            'password' => Hash::make('password123'),
            'role_id' => 9,
            'area_id' => 6
        ],
        [
            'id' => 6,
            'name' => 'test4',
            'email' => 'test4@member.com',
            'password' => Hash::make('password123'),
            'role_id' => 9,
            'area_id' => 6
        ],
        [
            'id' => 7,
            'name' => 'test5',
            'email' => 'test5@test.com',
            'password' => Hash::make('password123'),
            'role_id' => 9,
            'area_id' => 6
        ],

    ]);
    }
}
