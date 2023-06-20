<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Http\Livewire\Datatable\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Columns\ImageColumn;
use App\Http\Livewire\Datatable\Filters\SelectFilter;

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
                        'value' => $order->getPath(),
                    ],
                ]),
        ];
    }

    protected function getFilters(): array
    {
        return [
            //
        ];
    }

    protected function getQuery(): Builder
    {
        return Order::query()->latest();
    }
}
