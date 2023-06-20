<?php

namespace App\Http\Livewire\Forms\Fields;

use Illuminate\View\View;
use App\Http\Livewire\Forms\Form;

class CheckboxField extends Field
{
    public function render(Form $form): View
    {
        return view('livewire.forms.inputs.checkbox', [
            'form' => $form,
            'field' => $this,
        ]);
    }
}
