<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShoppingCartTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function get_balance(): void
    {
        /** @var \App\Models\Product $product */
        $product = Product::factory()->create();
        Image::factory()->create([
        'product_id' => $product->id
        ]);
    }
}
