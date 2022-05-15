<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function authorized_user_can_access_to_checkout()
    {
        $this->seed([RoleSeeder::class]);

        /** @var \App\Models\User $user */
        $user = User::factory()->enabled()->create();
        $user->assignRole('User');

        /** @var \App\Models\Product $product */
        $product = Product::factory()->create();
        Image::factory()->create([
        'product_id' => $product->id
        ]);

        Cart::add(
            $product->id,
            $product->name,
            $product->quantity,
            $product->price
        );

        $response = $this->actingAs($user)->get(route('payments.index'));

        $response->assertOk()
            ->assertViewIs('products.checkout')
            ->assertSeeText($product->name)
            ->assertRedirect(route('payments.store'));
    }
}
