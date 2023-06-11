<?php

namespace App\Http\Livewire\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithData
{
    /**
     * Query builder
     *
     * @var Builder
     */
    protected Builder $builder;

    /**
     * Set query builder
     *
     * @param Builder $builder
     * @return void
     */
    protected function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    /**
     * Get query builder
     *
     * @return Builder
     */
    protected function getBuilder(): Builder
    {
        return $this->builder;
    }
}