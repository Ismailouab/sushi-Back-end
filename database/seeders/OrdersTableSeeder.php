<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $client = Users::whereHas('role', function ($query) {
            $query->where('name', 'client'); 
        })->first();

        if ($client) {
            DB::table('orders')->insert([
                [
                    'user_id' => $client->id,  
                    'food_id' => 1,            
                    'quantity' => 2,
                    'total_price' => 20.50,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $client->id,
                    'food_id' => 2,
                    'quantity' => 1,
                    'total_price' => 12.99,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        } else {
            echo "No client user found. Orders not inserted.\n";
        }
            }
}
