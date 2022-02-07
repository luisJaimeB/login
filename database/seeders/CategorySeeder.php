<?php

namespace Database\Seeders;

use App\Constants\Categories;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Categories::toArray() as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
