<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Response;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authorized_user_can_access_to_purchace_history()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        /** @var \App\Models\User $user */
        $user = User::factory()->enabled()->create();
        $user->assignRole('Admin');

        $response = $this->actingAs($user)->get(route('invoices.index'));

        $response->assertOk()
        ->assertViewIs('invoices.index');
    }

    /** @test */
    public function unauthorized_user_can_not_access_to_purchace_history()
    {
        $this->seed([RoleSeeder::class, PermissionSeeder::class]);

        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('invoices.index'));

        $response->assertStatus(Response::HTTP_FORBIDDEN)
            ->assertRedirect(route('login'));
    }
}
