<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleUser = Role::create(['name' => 'Manager-investor']);
        $roleUser = Role::create(['name' => 'Manager-content']);
        $roleBan = Role::create(['name' => 'Ban']);

        $permissions = [
            'view-admin',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'posts-list',
            'posts-create',
            'posts-edit',
            'posts-delete',

            'menu-list',
            'menu-create',
            'menu-edit',
            'menu-delete',

            'tags-list',
            'tags-create',
            'tags-edit',
            'tags-delete',

            'investors-list',
            'investors-create',
            'investors-edit',
            'investors-delete',

            'managers-list',
            'managers-create',
            'managers-edit',
            'managers-delete',

            'sliders-list',
            'sliders-create',
            'sliders-edit',
            'sliders-delete',

            'settings-view',
            'settings-create',

            'notifications-view',
            'notifications-create',

        ];

        foreach ($permissions as $permission) {
            $permission = Permission::create(['name' => $permission]);
            $permission->assignRole($roleAdmin);
        }

        $user = User::findOrFail(1);
        $user->assignRole('admin');
        $user = User::findOrFail(2);
        $user->assignRole('admin');
        $user = User::findOrFail(3);
        $user->assignRole('admin');

    }
}
