<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'type' => 'sale_report',
            'schedule' => Report::SCHEDULE_DAILY,
            'notify_to' => 'nghuuquyen@gmail.com,info@qt-shops.com',
        ];
    }
}
