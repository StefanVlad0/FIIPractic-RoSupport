<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_tags = [
            [
                'id' => 2,
                'product_id' => 6,
                'tag_id' => 2,
            ],
            [
                'id' => 3,
                'product_id' => 7,
                'tag_id' => 2,
            ],
        ];

        DB::table('product_tag')->insert($product_tags);
    }
}
