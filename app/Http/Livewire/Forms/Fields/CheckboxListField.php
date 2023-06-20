<?php

namespace App\Http\Livewire\Forms\Fields;

use App\Http\Livewire\Forms\Form;
use Closure;
use Illuminate\View\View;

class CheckboxListField extends Field
{
    public ?Closure $options = null;

    public ?Closure $values = null;

    public ?Closure $option_label_format = null;

    /**
     * Set options
     */
    public function options(Closure $options): Field
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Set values
     */
    public function values(Closure $values): Field
    {
        $this->values = $values;

        return $this;
    }

    /**
     * Set formmat option callback
     */
    public function formatOptionLabel(Closure $option_label_format): Field
    {
        $this->option_label_format = $option_label_format;

        return $this;
    }

    /**
     * Get formatted option label text
     *
     * @param string $text
     * @return string
     */
    public function getFormattedOptionLabel(string $text): string
    {
        if ($this->option_label_format != null) {
            return ($this->option_label_format)($text);
        }

        return $text;
    }

    public function render(Form $form): View
    {
        $options = [];
        $values = [];

        if ($this->options != null) {
            $options = ($this->options)($form->getData(), $form->getMode());
        }

        if ($this->values != null) {
            $values = ($this->values)($form->getData(), $form->getMode());
        }

        return view('livewire.forms.inputs.checkbox-list', [
            'form' => $form,
            'field' => $this,
            'options' => $options,
            'values' => $values,
        ]);
    }
}
