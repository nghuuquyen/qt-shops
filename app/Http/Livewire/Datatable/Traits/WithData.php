<?php

namespace App\Http\Livewire\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithData
{
    protected array $per_page_options = [5, 10, 20, 30, 40, 50];

    public int $per_page = 10;

    /**
     * Query builder
     */
    protected Builder $builder;

    /**
     * Set query builder
     */
    protected function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    /**
     * Get query builder
     */
    protected function getBuilder(): Builder
    {
        return $this->builder;
    }

    /**
     * Set per page size
     */
    public function setPerPage($per_page): void
    {
        $this->per_page = $per_page;
    }

    /**
     * Get per page options
     *
     * @return array
     */
    public function getPerPageOptions(): array
    {
        return $this->per_page_options;
    }

    /**
     * Get table items
     *
     * @return void
     */
    public function getItems()
    {
        return $this->getBuilder()->paginate($this->per_page);
    }

    /**
     * Setup query builder
     */
    public function setupQueryBuilder(): void
    {
        $this->setBuilder($this->getQuery());

        $this->setBuilder($this->applySearch());

        $this->setBuilder($this->applyFilters());
    }
}
