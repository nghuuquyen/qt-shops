<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Table;
use App\Models\Report;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ReportTable extends Table
{
    protected function getColumns(): array
    {
        return [
            TextColumn::make('Title', 'title')->searchable(),

            TextColumn::make('Type', 'type')->format(fn ($value) => Str::headline($value))->searchable(),

            TextColumn::make('Schedule', 'schedule')->format(fn ($value) => Str::headline($value)),

            LinkColumn::make('Recently Report')
                ->value(function ($report) {

                    $last_report_file = optional($report->reportFiles()->latest()->first());

                    return [
                        [
                            'target' => '_blank',
                            'title' => $last_report_file->isProcessed() ? 'Download CSV' : '-',
                            'value' => $last_report_file->isProcessed()
                                ? route('reports.report-files.show', ['report' => $report->id, 'report_file' => $last_report_file->id])
                                : null,
                        ],
                    ];
                }),

            LinkColumn::make('Action')
                ->value(function ($report) {
                    $links = [];

                    if (auth()->user()->can('view', $report)) {
                        $links[] =                         [
                            'title' => 'View',
                            'value' => route('reports.show', ['report' => $report->id]),
                        ];
                    }

                    if (auth()->user()->can('update', $report)) {
                        $links[] = [
                            'title' => 'Edit',
                            'value' => route('reports.edit', ['report' => $report->id]),
                        ];
                    }

                    return $links;
                }),
        ];
    }

    protected function getQuery(): Builder
    {
        return Report::query();
    }
}
