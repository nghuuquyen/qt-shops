<?php

namespace App\Http\Livewire\Datatable\Filters;

class SelectFilter extends Filter
{
    protected array $options = [];

    public function options(array $options = []): SelectFilter
    {
        $this->options = $options;

        return $this;
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

    public function getView()
    {
        return 'livewire.datatable.filters.select';
    }

    public function getData()
    {
        return [
            'options' => $this->options,
        ];
    }
}