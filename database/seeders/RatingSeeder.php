<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ratings = [
            [
                'id' => 1,
                'user_id' => 1,
                'product_id' => 4,
                'rating' => 5,
                'content' => 'Review actualizat',
                'created_at' => '2024-04-16 12:44:41',
                'updated_at' => '2024-04-16 12:52:25'
            ],
            [
                'id' => 2,
                'user_id' => 4,
                'product_id' => 4,
                'rating' => 2,
                'content' => 'Nu prea mi-a placut',
                'created_at' => '2024-04-16 13:09:39',
                'updated_at' => '2024-04-16 14:41:35'
            ],
        ];

        DB::table('ratings')->insert($ratings);
    }
}
