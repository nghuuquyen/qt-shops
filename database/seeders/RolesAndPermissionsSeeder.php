<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        Permission::create(['name' => 'viewAny products']);
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'viewAny orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'viewAny customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);

        Permission::create(['name' => 'viewAny reports']);
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'create reports']);
        Permission::create(['name' => 'update reports']);
        Permission::create(['name' => 'delete reports']);

        Permission::create(['name' => 'viewAny roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'viewAny users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

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
