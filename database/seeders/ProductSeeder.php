<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 2,
                'user_id' => 4,
                'description' => 'Fruits',
                'image1' => '1712934759_image1.jpg',
                'image2' => '1712934759_image2.jpg',
                'image3' => '1712934759_image3.jpg',
                'quantity' => 2,
                'rating' => 0,
                'is_promoted' => 1,
                'created_at' => '2024-04-12 15:12:39',
                'updated_at' => '2024-04-13 11:40:24',
                'price' => 25
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'description' => 'Honey',
                'image1' => '1712936425_image1.jpg',
                'image2' => '1712936425_image2.jpg',
                'image3' => null,
                'quantity' => 7,
                'rating' => 0,
                'is_promoted' => 0,
                'created_at' => '2024-04-12 15:40:25',
                'updated_at' => '2024-04-12 15:40:25',
                'price' => 25
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'description' => 'Avocado',
                'image1' => '1712949666_image1.jpg',
                'image2' => '1712949666_image2.jpg',
                'image3' => null,
                'quantity' => 10,
                'rating' => 3.5,
                'is_promoted' => 0,
                'created_at' => '2024-04-12 19:21:06',
                'updated_at' => '2024-04-16 14:41:35',
                'price' => 40
            ],
            [
                'id' => 6,
                'user_id' => 1,
                'description' => 'Broccoli',
                'image1' => '1713364249_image1.jpg',
                'image2' => '1713364249_image2.jpg',
                'image3' => null,
                'quantity' => 25,
                'rating' => 0,
                'is_promoted' => 0,
                'created_at' => '2024-04-17 14:30:49',
                'updated_at' => '2024-04-17 14:30:49',
                'price' => 35
            ],
            [
                'id' => 7,
                'user_id' => 1,
                'description' => 'Rosii',
                'image1' => '1713378885_image1.jpg',
                'image2' => '1713378885_image2.jpg',
                'image3' => '1713378885_image3.jpg',
                'quantity' => 34,
                'rating' => 0,
                'is_promoted' => 1,
                'created_at' => '2024-04-17 18:34:45',
                'updated_at' => '2024-04-17 18:45:47',
                'price' => 50
            ],
        ];

        DB::table('products')->insert($products);
    }
}
