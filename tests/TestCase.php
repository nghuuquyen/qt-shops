<?php

namespace Tests;

use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Login as Aministrator
     *
     * @return void
     */
    public function loginAsAministrator()
    {
        $this->seed(RolesAndPermissionsSeeder::class);

        $admin = User::factory()
            ->state([
                'name' => 'Quyen Nguyen Huu',
                'email' => 'nghuuquyen@gmail.com',
            ])
            ->create()
            ->assignRole('aministrator');

        $this->actingAs($admin);
    }
}
