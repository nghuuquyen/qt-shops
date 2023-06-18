<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Report::factory()->create([
            'title' => 'Daily Sale Report',
            'type' => Report::SALE_REPORT,
            'schedule' => Report::SCHEDULE_DAILY,
            'notify_to' => Report::DEFAULT_REPORT_TO,
        ]);

        Report::factory()->create([
            'title' => 'Daily Customer Report',
            'type' => Report::CUSTOMER_REPORT,
            'schedule' => Report::SCHEDULE_DAILY,
            'notify_to' => Report::DEFAULT_REPORT_TO,
        ]);

        Report::factory()->create([
            'title' => 'Daily Product Performance Report',
            'type' => Report::PRODUCT_PERFORMANCE_REPORT,
            'schedule' => Report::SCHEDULE_DAILY,
            'notify_to' => Report::DEFAULT_REPORT_TO,
        ]);
    }
}
