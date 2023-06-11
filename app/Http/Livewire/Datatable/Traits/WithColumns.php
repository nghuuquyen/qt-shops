<?php

namespace App\Http\Livewire\Datatable\Traits;

use App\Http\Livewire\Datatable\Columns\Column;
use Illuminate\Support\Collection;

trait WithColumns
{
    public $columns = [];

    /**
     * Get display columns
     *
     * @return array
     */
    public function getDisplayColumns()
    {
        return $this->columns;
    }

    /**
     * Check column allow to display or not
     */
    public function isDisplayColumn(Column $column): bool
    {
        return $this->columns->firstWhere('title', $column->title)['display'] == true;
    }

    /**
     * Setup columns settings
     *
     * @return void
     */
    public function setupColumns(): void
    {
        $this->columns = collect($this->getColumns())->map(function ($column) {
            return [
                'uuid' => fake()->uuid(),
                'title' => $column->title,
                'display' => true,
            ];
        });
    }
}
