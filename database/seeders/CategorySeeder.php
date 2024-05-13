<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'title' => 'Category 1',
                'description' => 'Description of Category 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Category 2',
                'description' => 'Description of Category 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more categories as needed
        ]);
    }
}
