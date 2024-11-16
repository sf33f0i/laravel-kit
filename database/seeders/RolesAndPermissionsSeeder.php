<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = User::query()->where('email', 'admin@example.com')->firstOrFail();

        $permissionsAdmin = [
            'use-crud',
            'use-admin-panel',
        ];

        $permissionsByRole = [
            'admin' => $permissionsAdmin,
        ];

        /* Admin */
        foreach ($permissionsAdmin as $permission) {
            Permission::create(['name' => $permission]);
            $admin->givePermissionTo($permission);
        }

        foreach ($permissionsByRole as $role => $permissions) {
            $model = Role::create(['name' => $role]);
            foreach ($permissions as $permission) {
                $model->givePermissionTo($permission);
            }
        }

        $admin->assignRole('admin');
    }
}
