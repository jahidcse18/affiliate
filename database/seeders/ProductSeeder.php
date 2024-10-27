<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Wireless Mouse',
                'price' => 29.99,
                'description' => 'A wireless mouse with ergonomic design and long battery life.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bluetooth Headphones',
                'price' => 49.99,
                'description' => 'Noise-cancelling headphones with Bluetooth connectivity and great sound quality.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'USB-C Charger',
                'price' => 19.99,
                'description' => 'Fast charging USB-C charger compatible with most devices.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Smartwatch',
                'price' => 149.99,
                'description' => 'A stylish smartwatch with health tracking and notification features.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gaming Keyboard',
                'price' => 89.99,
                'description' => 'Mechanical keyboard with RGB backlighting and programmable keys.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

