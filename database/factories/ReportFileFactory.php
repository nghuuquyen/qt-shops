<?php

namespace Database\Factories;

use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportFile>
 */
class ReportFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report_id' => Report::factory(),
            'filename' => (string) Str::orderedUuid() . '.csv',
            'disk' => Report::REPORT_FILE_DISK,
        ];
    }
}
