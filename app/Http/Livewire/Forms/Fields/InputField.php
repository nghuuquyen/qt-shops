<?php

namespace App\Http\Livewire\Forms\Fields;

use App\Http\Livewire\Forms\Form;
use Illuminate\View\View;

class InputField extends Field
{
    public function render(Form $form): View
    {
        return view('livewire.forms.inputs.input', [
            'form' => $form,
            'field' => $this,
        ]);
    }
}
