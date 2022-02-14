<?php

namespace Tests\Feature\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function authorized_user_can_access_to_admin_product_list ()
    {
        $this->withoutExceptionHandling();
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        /** @var \App\Models\Product $product */
        $product = Product::factory()->create();
        Image::factory()->create([
        'product_id' => $product->id
        ]);

        /** @var \App\Models\User $user */
        $user = User::factory()->enabled()->create();
        $user->assignRole('Admin');
        $user->givePermissionTo('admin.products.index');

        $response = $this->actingAs($user)->get(route('admin.products.index'));

        $response->assertOk()
        ->assertViewIs('admin.products.index')
        ->assertViewHas('products', function ($data) use ($product) {
            return $data->getCollection()->first()->is($product);
        });
    }

    /** @test */
    public function authorized_user_can_access_to_admin_product_edit ()
    {
        $this->withoutExceptionHandling();
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        /** @var \App\Models\Product $product */
        $product = Product::factory()->create();
        Image::factory()->create([
            'product_id' => $product->id
        ]);

        /** @var \App\Models\User $user */
        $user = User::factory()->enabled()->create();
        $user->assignRole('Admin');
        $user->givePermissionTo('admin.products.edit');

        $response = $this->actingAs($user)->get(route('admin.products.edit', $product));

        $response->assertOk()
        ->assertViewIs('admin.products.edit');
    }

    /** @test */
    public function authorized_user_can_update_a_product ()
    {
        $this->withoutExceptionHandling();
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        /** @var \App\Models\Product $product */
        $product = Product::factory()->create();
        Image::factory()->create([
            'product_id' => $product->id
        ]);

        /** @var \App\Models\User $user */
        $user = User::factory()->enabled()->create();
        $user->assignRole('Admin');
        $user->givePermissionTo('admin.products.edit');

        $data = [
            'name' => $this->faker->sentence(2),
            'price' => $this->faker->randomNumber(4),
            'description' => $this->faker->sentence(10),
        ];

        $response = $this->actingAs($user)->put(route('admin.products.update', $product), $data);

        $response->assertRedirect(route('admin.products.show', $product));
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);
    }

     /** @test */
     public function authorized_user_can_access_to_admin_product_show ()
     {
        $this->withoutExceptionHandling();
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        /** @var \App\Models\Product $product */
        $product = Product::factory()->create();
        Image::factory()->create([
            'product_id' => $product->id
        ]);

        /** @var \App\Models\User $user */
        $user = User::factory()->enabled()->create();
        $user->assignRole('Admin');
        $user->givePermissionTo('admin.products.show');

        $response = $this->actingAs($user)->get(route('admin.products.show', $product));

        $response->assertOk()
        ->assertViewIs('admin.products.show')
        ->assertViewHas('product', $product);
     }

    /** @test */
    public function authorized_user_can_be_deleted_a_product ()
    {
        $this->withoutExceptionHandling();
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        /** @var \App\Models\Product $product */
        $product = Product::factory()->create();
        Image::factory()->create([
            'product_id' => $product->id
        ]);

        /** @var \App\Models\User $user */
        $user = User::factory()->enabled()->create();
        $user->assignRole('Admin');
        $user->givePermissionTo('admin.products.destroy');

        $response = $this->actingAs($user)->delete(route('admin.products.destroy', $product));

        $response->dumpSession()->assertRedirect(route('admin.products.index'));
            $this->assertDatabaseMissing('product', $product[]);
    }
}
