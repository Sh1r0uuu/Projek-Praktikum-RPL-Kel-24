<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Resep extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyRecipes = [
            [
                'title' => 'Greek Salad',
                'category' => 'Makanan Pembuka',
                'origin' => 'Mediterranean',
                'image' => 'images/greek_salad.jpg', // Path gambar relatif
                'time' => '15 mins',
                'type' => 'Makanan Pembuka',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Chicken Tikka Masala',
                'category' => 'Makanan Utama',
                'origin' => 'Indian',
                'image' => 'images/chicken_tikka_masala.jpg', // Path gambar relatif
                'time' => '45 mins',
                'type' => 'Makanan Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Beef Stroganoff',
                'category' => 'Makanan Utama',
                'origin' => 'Russian',
                'image' => 'images/beef_stroganoff.jpg', // Path gambar relatif
                'time' => '30 mins',
                'type' => 'Makanan Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pad Thai',
                'category' => 'Makanan Utama',
                'origin' => 'Thai',
                'image' => 'images/pad_thai.jpg', // Path gambar relatif
                'time' => '25 mins',
                'type' => 'Makanan Utama',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Chocolate Lava Cake',
                'category' => 'Makanan Penutup',
                'origin' => 'French',
                'image' => 'images/lava_cake.jpg', // Path gambar relatif
                'time' => '20 mins',
                'type' => 'Makanan Penutup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('recipes')->insert($dummyRecipes);
    }
}
