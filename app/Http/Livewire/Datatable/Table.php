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

    public string $table_name = 'defaut_table';

    public $search;

    public $data_filters = [];

    public $page_size_options = [5, 10, 20, 30, 40, 50];

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
        return $this->{$this->table_name}['filters'];
    }

    public function setPageSize($page_size)
    {
        $this->page_size = $page_size;
    }

    /**
     * Runs on every request, immediately after the component is instantiated, but before any other lifecycle methods are called
     */
    public function boot(): void
    {
        $this->{$this->table_name} = [
            'sorts' => $this->{$this->table_name}['sorts'] ?? [],
            'filters' => $this->{$this->table_name}['filters'] ?? [],
            'columns' => $this->{$this->table_name}['columns'] ?? [],
        ];
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

        $table = $this;
        
        return view('livewire.datatable.table', compact('table', 'columns', 'filters', 'items'));
    }
}
