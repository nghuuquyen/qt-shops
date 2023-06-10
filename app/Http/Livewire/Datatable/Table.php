<?php

namespace App\Http\Livewire\Datatable;

use App\Http\Livewire\Datatable\Traits\WithSearch;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithSearch;
    use WithPagination;

    public $search;

    public $page_size_options = [5, 10, 20, 30, 40, 50];

    public $page_size = 10;

    public $display_columns = [];

    protected Builder $builder;

    protected $queryString = [
        'search' => ['except' => ''],
        'page_size' => ['except' => 10],
    ];

    abstract protected function getColumns();

    abstract protected function getQuery();

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

    public function render()
    {
        $columns = $this->getColumns();

        foreach ($columns as &$column) {
            $column->display = $this->display_columns->firstWhere('title', $column->title)['display'];
        }

        $this->setBuilder($this->getQuery());

        $this->setBuilder($this->applySearch());

        $items = $this->getBuilder()->paginate($this->page_size);

        return view('livewire.datatable.table', compact('columns', 'items'));
    }
}
