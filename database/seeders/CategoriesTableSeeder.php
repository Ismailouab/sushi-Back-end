<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Sushi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Drinks', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Soup', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
