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
            'manage_users', 'create_users', 'edit_users', 'delete_users',
            'manage_posts', 'create_posts', 'edit_posts', 'delete_posts', 'publish_posts',
            'manage_categories', 'create_categories', 'edit_categories', 'delete_categories',
            'manage_tags', 'create_tags', 'edit_tags', 'delete_tags',
            'manage_media', 'upload_media', 'delete_media',
            'manage_settings',
            'manage_roles', 'create_roles', 'edit_roles', 'delete_roles',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }


        // Create Roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $editorRole = Role::create(['name' => 'editor']);
        $editorRole->givePermissionTo(['manage_posts', 'create_posts', 'edit_posts', 'publish_posts', 'manage_categories', 'manage_tags', 'manage_media']);

        $writerRole = Role::create(['name' => 'writer']);
        $writerRole->givePermissionTo(['create_posts', 'edit_posts', 'manage_media', 'upload_media']);
    }
}
