<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function loginAsAministrator()
    {
        $admin = Role::create(['name' => 'aministrator'])
        ->givePermissionTo(Permission::all());
    }
}
