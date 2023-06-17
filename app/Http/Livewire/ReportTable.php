<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Table;
use App\Models\Report;
use Illuminate\Database\Eloquent\Builder;

class ReportTable extends Table
{
    protected function getColumns(): array
    {
        return [
            TextColumn::make('Title', 'title')->searchable(),

            TextColumn::make('Created At', 'created_at'),

            TextColumn::make('Updated At', 'updated_at'),

            LinkColumn::make('Action')
                ->value(fn ($report) => [
                    [
                        'title' => 'View',
                        'value' => route('reports.show', ['report' => $report->id]),
                    ],
                    [
                        'title' => 'Edit',
                        'value' => route('reports.edit', ['report' => $report->id]),
                    ],
                ]),
        ];
    }

    protected function getQuery(): Builder
    {
        return Report::query();
    }
}
