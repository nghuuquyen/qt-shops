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

class ProductTable extends Table
{
    protected function getColumns(): array
    {
        return [
            ImageColumn::make('Image', 'display_image_url')
                ->size(70, 70)
                ->format(fn ($value) => $value.'?w=150&h=150'),

            TextColumn::make('Name', 'name')
                ->searchable(),

            TextColumn::make('Category', 'category.name'),

            TextColumn::make('Unit price incl. VAT', 'formatted_price'),

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
        return Product::query()->with('category');
    }
}
