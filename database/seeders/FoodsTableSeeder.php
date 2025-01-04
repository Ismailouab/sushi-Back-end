<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foods')->updateOrInsert(
            ['name' => 'California Roll'],
            [
                'description' => 'A delicious California roll with crab, avocado, and cucumber.',
                'price' => 10.99,
                'image' => 'images/foods/california_roll.jpg',
                'category_id' => 1,
                'rating' => 4.5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('foods')->updateOrInsert(
            ['name' => 'Sushi Nigiri'],
            [
                'description' => 'Fresh nigiri sushi with tuna and salmon.',
                'price' => 12.99,
                'image' => 'images/foods/sushi_nigiri.jpg',
                'category_id' => 1,
                'rating' => 4.8,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('foods')->updateOrInsert(
            ['name' => 'Green Tea'],
            [
                'description' => 'Refreshing Japanese green tea.',
                'price' => 3.50,
                'image' => 'images/foods/green_tea.jpg',
                'category_id' => 2,
                'rating' => 4.2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('foods')->updateOrInsert(
            ['name' => 'Soda'],
            [
                'description' => 'Chilled soda served with ice.',
                'price' => 2.50,
                'image' => 'images/foods/soda.jpg',
                'category_id' => 2,
                'rating' => 4.0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('foods')->updateOrInsert(
            ['name' => 'Spicy Tuna Roll'],
            [
                'description' => 'Spicy tuna wrapped in seaweed and rice.',
                'price' => 14.50,
                'image' => 'images/foods/spicy_tuna_roll.jpg',
                'category_id' => 1,
                'rating' => 4.7,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // New food items added
        DB::table('foods')->updateOrInsert(
            ['name' => 'Original Sushi'],
            [
                'description' => 'Authentic sushi with a variety of fresh fish and ingredients.',
                'price' => 15.99,
                'image' => 'images/foods/original_sushi.jpg',
                'category_id' => 1,
                'rating' => 4.9,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('foods')->updateOrInsert(
            ['name' => 'Chezu Sushi'],
            [
                'description' => 'Sushi with a twist of creamy cheese and fresh fish.',
                'price' => 16.50,
                'image' => 'images/foods/chezu_sushi.jpg',
                'category_id' => 1,
                'rating' => 4.3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Change category_id for Ramen Legendo, Udon, and Danggo to 3
        DB::table('foods')->updateOrInsert(
            ['name' => 'Ramen Legendo'],
            [
                'description' => 'A hearty bowl of ramen with a rich broth and tender pork belly.',
                'price' => 13.99,
                'image' => 'images/foods/ramen_legendo.jpg',
                'category_id' => 3,  // Changed category_id to 3
                'rating' => 4.6,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('foods')->updateOrInsert(
            ['name' => 'Udon'],
            [
                'description' => 'A warm, comforting bowl of udon noodles in a savory broth.',
                'price' => 11.50,
                'image' => 'images/foods/udon.jpg',
                'category_id' => 3,  // Changed category_id to 3
                'rating' => 4.4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('foods')->updateOrInsert(
            ['name' => 'Danggo'],
            [
                'description' => 'Sweet and chewy rice dumplings served with a syrupy sauce.',
                'price' => 5.00,
                'image' => 'images/foods/danggo.jpg',
                'category_id' => 3,  // Changed category_id to 3
                'rating' => 4.7,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('foods')->updateOrInsert(
            ['name' => 'Sushi'],
            [
                'description' => 'Freshly made sushi with an assortment of seafood.',
                'price' => 12.00,
                'image' => 'images/foods/sushi.jpg',
                'category_id' => 1,
                'rating' => 4.8,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
