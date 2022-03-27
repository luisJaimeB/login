<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function guest_user_is_redirected_to_login ()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function unauthorized_user_can_not_access_to_user_list ()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

     /** @test */
     public function authorized_user_can_access_to_user_list ()
     {
         $this->seed([RoleSeeder::class, PermissionSeeder::class]);

         /** @var \App\Models\User $user */
         $user = User::factory()->create();
         $user->assignRole('Admin');
         $user->givePermissionTo('users.index');

         $response = $this->actingAs($user)->get(route('users.index'));
 
         $response->assertOk()
            ->assertViewIs('users.index');
     }

    /** @test */
     public function unauthorized_user_can_not_access_to_product_list ()
     {
         /** @var \App\Models\User $user */
         $user = User::factory()->create();
 
         $response = $this->actingAs($user)->get(route('products.index'));
 
         $response->assertStatus(Response::HTTP_FORBIDDEN);
     }
}
