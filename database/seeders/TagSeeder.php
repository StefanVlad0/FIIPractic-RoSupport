<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'id' => 1,
                'name' => 'Fruits',
            ],
            [
                'id' => 2,
                'name' => 'Vegetables',
            ],
            [
                'id' => 3,
                'name' => 'Dairy',
            ],
            [
                'id' => 4,
                'name' => 'Other',
            ],
        ];

        DB::table('tags')->insert($tags);
    }
}
