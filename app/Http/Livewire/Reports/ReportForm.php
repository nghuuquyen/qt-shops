<?php

namespace App\Http\Livewire\Reports;

use App\Http\Livewire\Forms\Fields\InputField;
use App\Http\Livewire\Forms\Fields\SelectField;
use App\Http\Livewire\Forms\Form;
use App\Models\Report;
use Illuminate\Support\Str;

class ReportForm extends Form
{
    public function getAction(mixed $report, string $mode): string
    {
        return $mode == Form::MODE_EDIT
            ? route('reports.update', ['report' => $report->id])
            : route('reports.store');
    }

    public function getFields(): array
    {
        return [
            InputField::make('title'),

            SelectField::make('type')
                ->options(fn () => [
                    [
                        'value' => Report::SALE_REPORT,
                        'text' => Str::headline(Report::SALE_REPORT),
                    ],
                    [
                        'value' => Report::PRODUCT_PERFORMANCE_REPORT,
                        'text' => Str::headline(Report::PRODUCT_PERFORMANCE_REPORT),
                    ],
                    [
                        'value' => Report::CUSTOMER_REPORT,
                        'text' => Str::headline(Report::CUSTOMER_REPORT),
                    ],
                ]),

            SelectField::make('schedule')
                ->options(fn () => [
                    [
                        'value' => Report::SCHEDULE_DAILY,
                        'text' => Str::headline(Report::SCHEDULE_DAILY),
                    ],
                    [
                        'value' => Report::SCHEDULE_WEEKLY,
                        'text' => Str::headline(Report::SCHEDULE_WEEKLY),
                    ],
                ]),

            InputField::make('notify_to')->onViewExplodeAsTags(),
        ];
    }
}
