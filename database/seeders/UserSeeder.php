<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'abc',
                'email' => 'abc@gmail.com',
                'password' => Hash::make('abc'),
                'created_at' => '2024-04-09 07:57:24',
                'updated_at' => '2024-04-17 18:34:45',
                'bio' => 'Salut!',
                'profile_image' => '1712763455.jpg',
                'points' => 2,
            ],
            [
                'id' => 2,
                'name' => 'def',
                'email' => 'def@gmail.com',
                'password' => Hash::make('def'),
                'created_at' => '2024-04-09 09:57:31',
                'updated_at' => '2024-04-09 09:57:31',
                'bio' => null,
                'profile_image' => null,
                'points' => 0,
            ],
            [
                'id' => 4,
                'name' => 'zzz',
                'email' => 'zzz@gmail.com',
                'password' => Hash::make('zzz'),
                'created_at' => '2024-04-11 15:16:19',
                'updated_at' => '2024-04-12 15:12:39',
                'bio' => null,
                'profile_image' => null,
                'points' => 0,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
