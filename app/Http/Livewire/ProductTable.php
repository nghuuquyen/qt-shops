<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use App\Http\Livewire\Datatable\Table;
use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Columns\ImageColumn;
use App\Http\Livewire\Datatable\Filters\SelectFilter;

class ProductTable extends Table
{
    protected function getColumns()
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

    protected function getFilters()
    {
        return [
            SelectFilter::make('Category', 'category.id')
                ->options(
                    Category::get()
                        ->keyBy('id')
                        ->map(fn($category) => $category->name)
                        ->toArray()
                ),
        ];
    }

    protected function getQuery()
    {
        return Product::query();
    }
}
