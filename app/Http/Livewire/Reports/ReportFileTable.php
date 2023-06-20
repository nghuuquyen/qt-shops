<?php

namespace App\Http\Livewire\Reports;

use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Table;
use App\Models\Report;
use App\Models\ReportFile;
use Illuminate\Database\Eloquent\Builder;

class ReportFileTable extends Table
{
    public Report $report;

    protected function getColumns(): array
    {
        return [
            TextColumn::make('Filename', 'filename')->searchable(),

            TextColumn::make('Updated At', 'updated_at'),

            TextColumn::make('Status', 'display_status'),

            LinkColumn::make('Action')
                ->value(fn ($report_file) => [
                    [
                        'target' => '_blank',
                        'title' => $report_file->isProcessed() ? 'Download CSV' : '-',
                        'value' => $report_file->isProcessed()
                            ? route('reports.report-files.show', ['report' => $report_file->report->id, 'report_file' => $report_file->id])
                            : null,
                    ],
                ]),
        ];
    }

    protected function getQuery(): Builder
    {
        return ReportFile::query()->where('report_id', $this->report->id)->latest();
    }
}
