<?php

namespace App\Http\Livewire\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Datatable\Traits\Helpers\FilterHelper;

trait WithFilters
{
    use FilterHelper;
    
    /**
     * Get filters
     *
     * @return array
     */
    protected function getFilters(): array
    {
        return [];
    }

    /**
     * Apply filter query conditions
     *
     * @return Builder
     */
    public function applyFilters(): Builder
    {
        if ($this->hasFilters()) {
            foreach ($this->getFilters() as $filter) {
                foreach ($this->getAppliedFiltersWithValues() as $key => $value) {
                    if ($filter->getKey() === $key && $filter->hasFilterCallback()) {

                        if ($filter->validate($value) == false) {
                            continue;
                        }

                        $this->setBuilder(
                            ($filter->getFilterCallback())($this->getBuilder(), $value)
                        );
                    }
                }   
            }
        }

        return $this->getBuilder();
    }
}
