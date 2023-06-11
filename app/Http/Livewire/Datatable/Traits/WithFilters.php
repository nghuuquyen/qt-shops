<?php

namespace App\Http\Livewire\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithFilters
{
    public function applyFilters(): Builder
    {
        if ($this->hasFilters()) {
            foreach ($this->getFilters() as $filter) {
                foreach ($this->getAppliedFiltersWithValues() as $key => $value) {
                    if ($filter->getKey() === $key && $filter->hasFilterCallback()) {
                        // Let the filter class validate the value
                        $value = $filter->validate($value);

                        if ($value === false) {
                            continue;
                        }

                        ($filter->getFilterCallback())($this->getBuilder(), $value);
                    }
                }
            }
        }

        return $this->getBuilder();
    }
}
