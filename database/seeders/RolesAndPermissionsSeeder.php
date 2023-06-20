<?php

namespace Database\Seeders;

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
        /**
         * Reset cached roles and permissions
         */
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /**
         * Create permissions
         */
        Permission::create(['name' => 'viewAny products', 'group' => 'Product Management']);
        Permission::create(['name' => 'view products', 'group' => 'Product Management']);
        Permission::create(['name' => 'create products', 'group' => 'Product Management']);
        Permission::create(['name' => 'update products', 'group' => 'Product Management']);
        Permission::create(['name' => 'delete products', 'group' => 'Product Management']);

        Permission::create(['name' => 'viewAny orders', 'group' => 'Order Management']);
        Permission::create(['name' => 'view orders', 'group' => 'Order Management']);
        Permission::create(['name' => 'create orders', 'group' => 'Order Management']);
        Permission::create(['name' => 'update orders', 'group' => 'Order Management']);
        Permission::create(['name' => 'delete orders', 'group' => 'Order Management']);

        Permission::create(['name' => 'viewAny customers', 'group' => 'Customer Management']);
        Permission::create(['name' => 'view customers', 'group' => 'Customer Management']);
        Permission::create(['name' => 'create customers', 'group' => 'Customer Management']);
        Permission::create(['name' => 'update customers', 'group' => 'Customer Management']);
        Permission::create(['name' => 'delete customers', 'group' => 'Customer Management']);

        Permission::create(['name' => 'viewAny reports', 'group' => 'Report Management']);
        Permission::create(['name' => 'view reports', 'group' => 'Report Management']);
        Permission::create(['name' => 'create reports', 'group' => 'Report Management']);
        Permission::create(['name' => 'update reports', 'group' => 'Report Management']);
        Permission::create(['name' => 'delete reports', 'group' => 'Report Management']);

        Permission::create(['name' => 'viewAny roles', 'group' => 'User Management']);
        Permission::create(['name' => 'view roles', 'group' => 'User Management']);
        Permission::create(['name' => 'create roles', 'group' => 'User Management']);
        Permission::create(['name' => 'update roles', 'group' => 'User Management']);
        Permission::create(['name' => 'delete roles', 'group' => 'User Management']);

        Permission::create(['name' => 'viewAny users', 'group' => 'User Management']);
        Permission::create(['name' => 'view users', 'group' => 'User Management']);
        Permission::create(['name' => 'create users', 'group' => 'User Management']);
        Permission::create(['name' => 'update users', 'group' => 'User Management']);
        Permission::create(['name' => 'delete users', 'group' => 'User Management']);

        /**
         *  Create roles and assign created permissions
         */
        Role::create(['name' => 'aministrator'])
            ->givePermissionTo(Permission::all());

        Role::create(['name' => 'owner'])
            ->givePermissionTo([
                'viewAny products', 'view products', 'create products', 'update products', 'delete products',
                'viewAny orders', 'view orders', 'create orders', 'update orders', 'delete orders',
                'viewAny customers', 'view customers', 'create customers', 'update customers', 'delete customers',
                'viewAny reports', 'view reports', 'create reports', 'update reports', 'delete reports',
            ]);

        Role::create(['name' => 'saler'])
            ->givePermissionTo([
                'viewAny products', 'view products',
                'viewAny orders', 'view orders',
                'viewAny customers', 'view customers',
                'viewAny reports', 'view reports', 'create reports',
            ]);

        Role::create(['name' => 'viewer'])
            ->givePermissionTo([
                'viewAny products', 'view products',
                'viewAny orders', 'view orders',
                'viewAny customers', 'view customers',
                'viewAny reports', 'view reports',
            ]);
    }
}
