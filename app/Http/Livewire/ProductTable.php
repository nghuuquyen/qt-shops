<?php

namespace App\Http\Livewire;

use App\Models\Product;

class ProductTable extends Datatable
{
    protected function getColumns()
    {
        return [
            [
                'name' => 'Image',
                'type' => DataTable::IMAGE_COLUMN,
                'field' => 'display_image_url',
                'format' => fn($value) => $value . '?w=150&h=150',
            ],
            [
                'name' => 'Name',
                'type' => DataTable::TEXT_COLUMN,
                'field' => 'name',
            ],
            [
                'name' => 'Unit price incl. VAT',
                'type' => DataTable::TEXT_COLUMN,
                'field' => 'formatted_price',
            ],
            [
                'name' => 'Action',
                'type' => DataTable::LINK_COLUMN,
                'title' => 'View',
                'value' => fn($product) => route('products.show', ['product' => $product->id])
            ],
        ];
    }

    protected function getQuery()
    {
        return Product::query();
    }
}
