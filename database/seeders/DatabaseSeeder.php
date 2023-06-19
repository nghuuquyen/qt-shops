<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\OrderSeeder;
use Database\Seeders\ReportSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            ReportSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
