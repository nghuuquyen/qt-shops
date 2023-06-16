<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Datatable\Columns\ImageColumn;
use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Filters\SelectFilter;
use App\Http\Livewire\Datatable\Table;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductTable extends Table
{
    protected function getColumns(): array
    {
        return [
            ImageColumn::make('Image', 'display_image_url')
                ->size(50, 50)
                ->format(fn ($value) => $value.'?w=150&h=150'),

            TextColumn::make('Name', 'name')
                ->searchable(),

            TextColumn::make('Category', 'category.name'),

            TextColumn::make('Unit price incl. VAT', 'formatted_price'),

            TextColumn::make('Total Orders', 'total_orders'),

            LinkColumn::make('Action')
                ->value(fn ($product) => [
                    [
                        'title' => 'View',
                        'value' => route('products.show', ['product' => $product->id]),
                    ],
                    [
                        'title' => 'Edit',
                        'value' => route('products.edit', ['product' => $product->id]),
                    ],
                ]),
        ];
    }

    protected function getFilters(): array
    {
        return [
            SelectFilter::make('Category')
                ->options(
                    Category::get()
                        ->keyBy('id')
                        ->map(fn ($category) => $category->name)
                        ->toArray()
                )
                ->filter(function (Builder $query, $value) {
                    return $query->where('category_id', $value);
                }),

            SelectFilter::make('Status')
                ->options([
                    1 => 'Active',
                    0 => 'Disabled',
                ]),
        ];
    }

    protected function getQuery(): Builder
    {
        return Product::query()->with('category')
            ->select('*')
            ->addSelect(DB::raw('
                (
                    SELECT
                        COUNT(0) 
                    FROM cart_items
                    JOIN carts ON cart_items.cart_id = carts.id
                    JOIN orders ON carts.id = orders.cart_id
                    WHERE cart_items.product_id = products.id
                ) as total_orders'
            ));
    }
}
