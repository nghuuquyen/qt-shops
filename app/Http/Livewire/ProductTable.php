<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Http\Livewire\Datatable\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Columns\ImageColumn;
use App\Http\Livewire\Datatable\Filters\SelectFilter;

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
                ->value(fn ($product) => route('products.show', ['product' => $product->id])),
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
