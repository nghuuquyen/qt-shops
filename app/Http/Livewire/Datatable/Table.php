<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Datatable\Filters\Filter;
use App\Http\Livewire\Datatable\Traits\WithSearch;
use App\Http\Livewire\Datatable\Traits\WithFilters;

abstract class Table extends Component
{
    use WithSearch;
    use WithFilters;
    use WithPagination;

    public $search;

    public $data_filters = [];

    public $page_size_options = [5, 10, 20, 30, 40, 50];

    protected $listeners = ['FILTER_CHANGE' => 'filterChanged'];

    public $page_size = 10;

    public $display_columns = [];

    protected Builder $builder;

    protected $queryString = [
        'search' => ['except' => ''],
        'data_filters' => ['except' => []],
        'page_size' => ['except' => 10],
    ];

    abstract protected function getColumns();

    abstract protected function getQuery();

    protected function getFilters()
    {
        return [];
    }

    protected function setBuilder(Builder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    protected function getBuilder()
    {
        return $this->builder;
    }

    public function hasSearch()
    {
        return isset($this->search);
    }

    public function hasFilters()
    {
        return count($this->getFilters()) > 0;
    }

    public function getAppliedFiltersWithValues()
    {
        return [];
    }

    public function setPageSize($page_size)
    {
        $this->page_size = $page_size;
    }

    public function mount()
    {
        $this->display_columns = collect($this->getColumns())->map(function ($column) {
            return [
                'id' => fake()->uuid(),
                'title' => $column->title,
                'display' => true,
            ];
        });
    }

    public function filterChanged(Filter $filter, $value)
    {

    }

    public function render()
    {
        $columns = $this->getColumns();

        foreach ($columns as &$column) {
            $column->display = $this->display_columns->firstWhere('title', $column->title)['display'];
        }

        $filters = $this->getFilters();

        $this->setBuilder($this->getQuery());

        $this->setBuilder($this->applySearch());

        $this->setBuilder($this->applyFilters());

        $items = $this->getBuilder()->paginate($this->page_size);

        return view('livewire.datatable.table', compact('columns', 'filters', 'items'));
    }
}
