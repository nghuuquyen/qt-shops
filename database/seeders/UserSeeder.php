<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->state([
                'name' => 'Quyen Nguyen Huu',
                'email' => 'nghuuquyen@gmail.com',
            ])
            ->create()
            ->assignRole('aministrator');

        User::factory()
            ->state([
                'name' => 'Owner Account',
                'email' => 'owner@qt-shops.com',
            ])
            ->create()
            ->assignRole('owner');

        User::factory()
            ->state([
                'name' => 'Saler Account',
                'email' => 'saler@qt-shops.com',
            ])
            ->create()
            ->assignRole('saler');

        User::factory()
            ->state([
                'name' => 'Viewer Account',
                'email' => 'viewer@qt-shops.com',
            ])
            ->create()
            ->assignRole('viewer');
    }
}
