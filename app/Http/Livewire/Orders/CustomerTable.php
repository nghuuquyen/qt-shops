<?php

namespace App\Http\Livewire\Orders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Datatable\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Datatable\Columns\TextColumn;

class CustomerTable extends Table
{
    protected function getColumns(): array
    {
        return [
            TextColumn::make('Full Name', 'full_name')->searchable(),

            TextColumn::make('Phone', 'phone_number')->searchable(),

            TextColumn::make('Email', 'email')->searchable(),

            TextColumn::make('Orders', 'total_order'),

            TextColumn::make('Products', 'total_products'),

            TextColumn::make('Spent', 'total_spent')
                ->format(fn ($value) => number_format($value) . ' ' . Product::DEFAULT_CURRENCY ),
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
        return Order::query()
            ->select([
                'full_name',
                'phone_number',
                'email',
            ])
            ->addSelect(DB::raw('COUNT(DISTINCT orders.id) as total_order'))
            ->addSelect(DB::raw('SUM(DISTINCT products.id) as total_products'))
            ->addSelect(DB::raw('SUM(cart_items.quantity * products.price) as total_spent'))

            ->leftJoin('carts', 'orders.cart_id', '=', 'carts.id')
            ->leftJoin('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->leftJoin('products', 'products.id', '=', 'cart_items.product_id')
            
            ->groupBy('full_name', 'phone_number', 'email')
            ->orderBy('total_spent', 'DESC')
            ->orderBy('total_order', 'DESC');
    }
}
