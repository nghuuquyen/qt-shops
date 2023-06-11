<?php

namespace App\Http\Livewire\Datatable\Filters;

use Illuminate\View\View;
use App\Http\Livewire\Datatable\Table;

class SelectFilter extends Filter
{
    /**
     * Filter options
     *
     * @var array
     */
    protected array $options = [];

    /**
     * Placeholder text
     *
     * @var string|null
     */
    protected ?string $placeholder = null;

    /**
     * Set options
     *
     * @param array $options
     * @return SelectFilter
     */
    public function options(array $options = []): SelectFilter
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Set the placeholder
     *
     * @param [type] $placeholder
     * @return SelectFilter
     */
    public function placeholder($placeholder): SelectFilter
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Get array of keys of filter options
     *
     * @return array
     */
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

    /**
     * Do validate filter value
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate(mixed $value): bool
    {
        if (! in_array($value, $this->getKeys())) {
            return false;
        }

        return true;
    }

    /**
     * Get filter pull title
     *
     * @return string
     */
    public function getFilterPillTitle(): string
    {
        return $this->name;
    }

    /**
     * Get filter pill value
     *
     * @param mixed $value
     * @return string
     */
    public function getFilterPillValue(mixed $value): string
    {
        foreach ($this->options as $key => $text) {
            if ($key == $value) {
                return $text;
            }
        }
    }

    /**
     * Render filter view
     *
     * @param Table $table
     * @return View
     */
    public function render(Table $table): View
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
