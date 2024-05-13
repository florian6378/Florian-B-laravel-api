<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;




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
                'name' => 'Product 1',
                'description' => 'Description of Product 1',
                'price' => 10.99,
                'stock' => 100,
                'category_id' => 1, // Assuming you have categories already seeded
                'image' => 'product1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product 2',
                'description' => 'Description of Product 2',
                'price' => 19.99,
                'stock' => 50,
                'category_id' => 2, // Assuming you have categories already seeded
                'image' => 'product2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more products as needed
        ]);
    }
}
