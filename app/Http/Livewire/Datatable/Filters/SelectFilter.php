<?php

namespace App\Http\Livewire\Datatable\Filters;

use App\Http\Livewire\Datatable\Table;

class SelectFilter extends Filter
{
    protected array $options = [];

    protected $placeholder;

    public function options(array $options = []): SelectFilter
    {
        $this->options = $options;

        return $this;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getKeys(): array
    {
        return collect($this->getOptions())
            ->map(fn ($value, $key) => is_iterable($value) ? collect($value)->keys() : $key)
            ->flatten()
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => strlen($value) > 0)
            ->values()
            ->toArray();
    }

    public function validate($value)
    {
        if (! in_array($value, $this->getKeys())) {
            return false;
        }

        return true;
    }

    public function getFilterPillTitle()
    {
        return $this->name;
    }

    public function getFilterPillValue($value)
    {
        foreach ($this->options as $key => $text) {
            if ($key == $value) {
                return $text;
            }
        }
    }

    public function render(Table $table)
    {
        return view('livewire.datatable.filters.select', [
            'table' => $table,
            'name' => $this->name,
            'filter' => $this,
            'options' => $this->options,
            'placeholder' => $this->placeholder,
        ]);
    }
}
