<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Existing Permissions in Project
            'create customers',
            'create email templates',
            'create inventory type',
            'create sales channel',
            'create sales channel sub product',
            'create user groups',
            'create user permissions',
            'create user roles',
            'create users',
            'delete customers',
            'delete email templates',
            'delete inventory type',
            'delete sales channel',
            'delete sales channel sub product',
            'delete user groups',
            'delete user permissions',
            'delete user roles',
            'delete users',
            'edit customers',
            'edit email templates',
            'edit inventory orders',
            'edit inventory type',
            'edit sales channel',
            'edit sales channel sub product',
            'edit user groups',
            'edit user permissions',
            'edit user roles',
            'edit users',
            'manage customers',
            'manage email templates',
            'manage inventory orders',
            'manage inventory report',
            'manage inventory type',
            'manage orders',
            'manage role permissions',
            'manage sales channel',
            'manage sales channel sub product',
            'manage user groups',
            'manage user permissions',
            'manage user roles',
            'manage users',

            // New Permissions for missing menus/controls
            'manage dashboard',
            'manage shipping labels',
            'manage packing slips',
            'manage pos',
            'manage inventory',
            'manage barcodes',
            'manage stock adjustment',
            'manage payments',
            'manage order reports',
            'manage payment reports',

            // Granular permissions for packing slips & shipping labels
            'create packing slips',
            'edit packing slips',
            'delete packing slips',
            'create shipping labels',
            'edit shipping labels',
            'delete shipping labels',
        ];

        // Seed all permissions
        foreach ($permissions as $name) {
            Permission::firstOrCreate(
                ['name' => $name, 'guard_name' => 'web'],
                ['is_active' => 1]
            );
        }

        // Retrieve roles
        // $adminRole = Role::where('name', 'admin')->first();
        // $operatorRole = Role::where('name', 'operator')->first();

        // Assign permissions to Admin role (all permissions)
        // if ($adminRole) {
        //     $adminRole->syncPermissions($permissions);
        // }

        // Assign a subset of operational permissions to Operator role
        // if ($operatorRole) {
        //     $operatorRole->syncPermissions([
        //         'manage dashboard',
        //         'manage orders',
        //         'manage shipping labels',
        //         'manage packing slips',
        //         'manage pos',
        //         'manage inventory',
        //         'manage barcodes',
        //         'manage inventory orders',
        //         'edit inventory orders',
        //         'manage stock adjustment',
        //         'manage payments',
        //         'manage customers',
        //         'manage order reports',
        //         'manage payment reports',
        //         'manage inventory report',
        //     ]);
        // }
    }
}
