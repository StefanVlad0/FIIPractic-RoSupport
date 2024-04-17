<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'id' => 2,
                'user_id' => 1,
                'description' => 'La noi gasesti legume BIO!',
                'image' => '1712781339.jpg',
                'likes' => 0,
                'created_at' => '2024-04-10 20:35:39',
                'updated_at' => '2024-04-16 10:08:16'
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'description' => 'Si la noi sunt produse BIO :)',
                'image' => '1712781964.jpg',
                'likes' => 0,
                'created_at' => '2024-04-10 20:46:04',
                'updated_at' => '2024-04-16 15:18:17'
            ],
        ];

        DB::table('posts')->insert($posts);
    }
}
