<?php

namespace App\Http\Livewire\Products;

use App\Http\Livewire\Forms\Fields\InputField;
use App\Http\Livewire\Forms\Form;
use App\Models\Product;

class ProductForm extends Form
{
    public function getAction(mixed $product, string $mode): string
    {
        return $mode == Form::MODE_EDIT
            ? route('products.update', ['product' => $product->id])
            : route('products.store');
    }

    public function getFields(): array
    {
        return [
            InputField::make('name'),

            InputField::make('display_image_url', 'Display Image'),

            InputField::make('formatted_price', 'Unit price incl. VAT')
                ->hideOnEdit(),

            InputField::make('price', 'Unit price incl. VAT')
                ->type('number')
                ->suffix(fn () => Product::DEFAULT_CURRENCY)
                ->hideOnView(),

            InputField::make('description'),
        ];
    }
}
