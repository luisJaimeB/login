<?php

namespace Database\Seeders;

use App\Constants\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        foreach (Roles::toArray() as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
