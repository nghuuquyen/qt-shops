<?php

namespace App\Http\Livewire\Datatable\Traits;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Datatable\Columns\Column;

trait WithColumns
{
    public $display_columns = [];

    /**
     * Get display columns
     *
     * @return array
     */
    public function getDisplayColumns(): Collection
    {
        return $this->display_columns;
    }

    /**
     * Check column allow to display or not
     *
     * @param Column $column
     * @return boolean
     */
    public function isDisplayColumn(Column $column): bool
    {
        return $this->display_columns->firstWhere('title', $column->title)['display'] == true;
    }
}