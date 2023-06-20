<?php

namespace App\Http\Livewire\Orders;

use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Table;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;

class OrderTable extends Table
{
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

    protected function getQuery(): Builder
    {
        return Order::query()->latest();
    }
}
