<?php

namespace App\Http\Livewire\Datatable\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WithSearch
{
    public function getSearchableColumns()
    {
        $searchable_columns = [];

        foreach ($this->getColumns() as $column) {
            if ($column->isSearchable()) {
                $searchable_columns[] = $column;
            }
        }

        return $searchable_columns;
    }

    public function getSearch()
    {
        return $this->search;
    }

    public function applySearch(): Builder
    {
        if ($this->hasSearch()) {
            $searchable_columns = $this->getSearchableColumns();

            if (count($searchable_columns)) {
                $this->setBuilder($this->getBuilder()->where(function ($query) use ($searchable_columns) {
                    foreach ($searchable_columns as $index => $column) {
                        if ($column->hasSearchCallback()) {
                            ($column->getSearchCallback())($query, $this->getSearch());
                        } else {
                            $query->{$index === 0 ? 'where' : 'orWhere'}($column->getColumn(), 'like', '%'.$this->getSearch().'%');
                        }
                    }
                }));
            }
        }

        return $this->getBuilder();
    }
}
