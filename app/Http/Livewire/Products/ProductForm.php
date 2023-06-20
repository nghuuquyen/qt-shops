<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Http\Livewire\Forms\Form;
use App\Http\Livewire\Forms\Fields\InputField;

class ProductForm extends Form
{
    public function getMethod(mixed $product, string $mode): string
    {
        return $mode == Form::MODE_EDIT ? 'PUT' : 'POST';
    }

    public function getAction(mixed $product, string $mode): string
    {
        return $mode == Form::MODE_EDIT
            ? route('products.update', ['product' => $product->id])
            : route('products.store');
    }

    public function getFields(): array
    {
        return [
            InputField::make('name', 'Name'),

            InputField::make('price', 'Unit price incl. VAT')
                ->type('number')
                ->suffix(fn () => Product::DEFAULT_CURRENCY),

            InputField::make('description', 'Description'),
        ];
    }
}
