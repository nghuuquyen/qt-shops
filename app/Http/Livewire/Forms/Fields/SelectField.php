<?php

namespace App\Http\Livewire\Forms\Fields;

use Illuminate\View\View;
use App\Http\Livewire\Forms\Form;

class SelectField extends Field
{
    public function render(Form $form): View
    {
        return view('livewire.forms.inputs.select', [
            'form' => $form,
            'field' => $this,
        ]);
    }
}
