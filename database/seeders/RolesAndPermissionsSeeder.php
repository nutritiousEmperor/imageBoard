<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        // Note for mentor: This is not ai generated code, I got it from the documentation: https://spatie.be/docs/laravel-permission/v6/advanced-usage/seeding

        Permission::create(['name' => 'create board']); // For the admins
        Permission::create(['name' => 'delete board']); // For the admins
        Permission::create(['name' => 'create thread']); // For the regular user and above
        Permission::create(['name' => 'delete thread']); // For the mods or creater of the thread
        Permission::create(['name' => 'post content']); // For the regular user and above
        Permission::create(['name' => 'delete user']); // For the admins and mods, if you are a mod, you can only delete users with less permissions than you
        Permission::create(['name' => 'assign any role']); // For the admins
        Permission::create(['name' => 'assign mod role']); // For the mods
        Permission::create(['name' => 'remove any role']); // For the admins
        Permission::create(['name' => 'remove mod role']); // For the mods

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'create board',
            'delete board',
            'create thread',
            'delete thread',
            'post content',
            'delete user',
            'assign any role',
            'remove any role',
        ]);

        $mod = Role::create(['name' => 'mod']);
        $mod->givePermissionTo([
            'create thread',
            'delete thread',
            'delete user', // if you are a mod, you can only delete users with less permissions than you
            'post content',
            'assign mod role',
            'remove mod role',
        ]);

        $defaultUser = Role::create(['name' => 'default user']);
        $defaultUser->givePermissionTo([
            'create thread',
            'delete thread', // Only if you are the creator of the thread
            'post content',
        ]);
    }
}
