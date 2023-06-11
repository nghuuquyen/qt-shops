<?php

namespace App\Http\Livewire\Datatable\Traits\Helpers;

use App\Http\Livewire\Datatable\Filters\Filter;

trait FilterHelper
{
    /**
     * Check has filters or not
     */
    public function hasFilters(): bool
    {
        return count($this->getFilters()) > 0;
    }

    /**
     * Get user applied filters as key and value
     *
     * @return void
     */
    public function getAppliedFiltersWithValues(): array
    {
        return $this->{$this->table_name}['filters'];
    }

    /**
     * Check has fitler pills or not
     */
    public function hasFilterPills(): bool
    {
        $count = 0;

        foreach ($this->getAppliedFiltersWithValues() as $key => $value) {
            $filter = $this->getFilterByKey($key);

            if ($filter->validate($value)) {
                $count++;
            }
        }

        return $count > 0;
    }

    /**
     * Get filter instance by key
     */
    public function getFilterByKey(string $key): Filter
    {
        return collect($this->getFilters())->first(function ($filter) use ($key) {
            return $filter->getKey() === $key;
        });
    }

    /**
     * Remove filter by key
     */
    public function removeFilter(Filter|string $filter): void
    {
        if (! $filter instanceof Filter) {
            $filter = $this->getFilterByKey($filter);
        }

        unset($this->{$this->table_name}['filters'][$filter->getKey()]);

        $this->resetPage();
    }

    /**
     * Remove all filters
     *
     * @return void
     */
    public function removeAllFilter(): void
    {
        $this->{$this->table_name}['filters'] = [];

        $this->resetPage();
    }
}
