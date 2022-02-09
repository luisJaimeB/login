<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        event(new Registered($user));
        $user->assignRole('Admin');
    }
}
