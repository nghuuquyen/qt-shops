<?php

namespace App\Http\Livewire\Forms\Fields;

use App\Http\Livewire\Forms\Form;
use Closure;
use Illuminate\View\View;

class SelectField extends Field
{
    public ?Closure $options = null;

    /**
     * Set options
     */
    public function options(Closure $options): Field
    {
        $this->options = $options;

        return $this;
    }

    public function render(Form $form): View
    {
        $options = [];

        if ($this->options != null) {
            $options = ($this->options)();
        }

        return view('livewire.forms.inputs.select', [
            'form' => $form,
            'field' => $this,
            'options' => $options,
        ]);
    }
}
