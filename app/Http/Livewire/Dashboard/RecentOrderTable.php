<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Table;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class RecentOrderTable extends Table
{
    /**
     * Override quer string of base table
     *
     * @var array
     */
    protected $queryString = [
        'search' => ['except' => ''],
        'per_page' => ['except' => 10],
        'datatable' => ['except' => []],
        'range_dates' => ['except' => []],
    ];

    protected $listeners = ['DashboardRangeDateChanged' => 'setRangeDates'];

    public $range_dates;

    protected function getColumns(): array
    {
        return [
            TextColumn::make('Code', 'code')->searchable(),

            TextColumn::make('Date', 'created_at')->searchable(),

            TextColumn::make('Full Name', 'full_name')->searchable(),

            TextColumn::make('Phone', 'phone_number')->searchable(),

            TextColumn::make('Email', 'email')->searchable(),

            LinkColumn::make('Action')
                ->value(fn ($order) => [
                    [
                        'title' => 'View',
                        'value' => route('orders.show', ['order' => $order->id]),
                    ],
                ]),
        ];
    }

    public function setRangeDates($range_dates)
    {
        $this->range_dates = $range_dates;
    }

    protected function getQuery(): Builder
    {
        return Order::query()
            ->when($this->range_dates, function (Builder $query, $range_dates) {
                $query->whereBetween('orders.created_at', [$range_dates['start_date'], $range_dates['end_date']]);
            })
            ->latest();
    }
}
