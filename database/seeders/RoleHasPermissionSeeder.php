<?php

namespace Database\Seeders;

use App\Constants\Permissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        /* $adminPermissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($adminPermissions->pluck('id')); */

        $roleAdmin = Role::where('name', 'Admin')->first();

        foreach (Permissions::permissionToAdmin() as $permission) {
            $permission = Permission::where('name', $permission)->first();
            $roleAdmin->givePermissionTo($permission);
        }

        /* // User
        $userPermissions = $adminPermissions->filter(function($permission) {
            return substr($permission->name, 0, 5) != 'user_' &&
                substr($permission->name, 0, 5) != 'role_' &&
                substr($permission->name, 0, 11) != 'permission_';
        });
        Role::findOrFail(2)->permissions()->sync($userPermissions); */

        //User
        $roleUser = Role::where('name', 'User')->first();

        foreach (Permissions::permissionToUser() as $permission) {
            $permission = Permission::where('name', $permission)->first();
            $roleUser->givePermissionTo($permission);
        }
    }
}
