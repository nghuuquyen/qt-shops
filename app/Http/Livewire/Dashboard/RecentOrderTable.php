<?php

namespace App\Http\Livewire\Dashboard;

use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Table;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class RecentOrderTable extends Table
{
    protected $listeners = ['DashboardRangeDateChanged' => 'updateRangeDate'];

    public $range_date;

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

    public function updateRangeDate($range_date)
    {
        $this->range_date = $range_date;
    }

    public function mount()
    {
        parent::mount();

        $this->range_date = request()->get('range_date');
    }

    protected function getQuery(): Builder
    {
        return Order::query()
            ->when($this->range_date, function (Builder $query, $range_dates) {
                $query->whereBetween('orders.created_at', [$range_dates['start'], $range_dates['end']]);
            })
            ->latest();
    }
}
