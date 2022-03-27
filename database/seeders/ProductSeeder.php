<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(50)->create()
            ->each(function (Product $product) {
                Image::factory()->create([
                    'product_id' => $product->id
                ]);
            });
    }
}
