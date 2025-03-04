<?php

// database/seeders/RolesAndPermissionsSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'manage_users',
            'manage_posts',
            'manage_categories',
            'manage_tags',
            'manage_media',
            'manage_sales',
            'manage_settings',
            'manage_roles',
            'process_orders',
            'manage_applications',
            'manage_careers',
            'manage_messages',
            'manage_employees',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        // Create Roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo(['manage_posts', 'manage_media','manage_messages']);

        $writerRole = Role::create(['name' => 'writer']);
        $writerRole->givePermissionTo(['process_orders', 'manage_careers', 'manage_media']);
    }
}
