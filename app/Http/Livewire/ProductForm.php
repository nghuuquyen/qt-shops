<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Forms\Fields\InputField;
use App\Http\Livewire\Forms\Form;

class ProductForm extends Form
{
    public function getMethod(mixed $data): string
    {
        return isset($data->id) ? 'PUT' : 'POST';
    }

    public function getAction(mixed $data): string
    {
        return isset($data->id)
            ? route('products.update', ['product' => $data->id])
            : route('products.store');
    }

    public function getFields(): array
    {
        return [
            InputField::make('name', 'Name'),

            InputField::make('price', 'Unit price incl. VAT')->type('number'),

            InputField::make('description', 'Description'),
        ];
    }
}
