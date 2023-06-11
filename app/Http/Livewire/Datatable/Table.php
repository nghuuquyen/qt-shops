<?php

namespace App\Http\Livewire\Datatable;

use App\Http\Livewire\Datatable\Filters\Filter;
use App\Http\Livewire\Datatable\Traits\WithColumns;
use App\Http\Livewire\Datatable\Traits\WithData;
use App\Http\Livewire\Datatable\Traits\WithFilters;
use App\Http\Livewire\Datatable\Traits\WithSearch;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithColumns,
        WithSearch,
        WithFilters,
        WithData,
        WithPagination;

    public string $table_name = 'datatable';

    protected $queryString = [
        'search' => ['except' => ''],
        'per_page' => ['except' => 10],
        'datatable' => ['except' => []],
    ];

    /**
     * Get table columns
     *
     * @return void
     */
    abstract protected function getColumns(): array;

    /**
     * Get table query builder
     */
    abstract protected function getQuery(): Builder;

    /**
     * Hook on updating data
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function updating($name, $value)
    {
        // need reset pagination if we updating the search and filter condition
        if (Str::startsWith($name, $this->table_name.'.filters') || $name == 'search') {
            $this->resetPage();
        }
    }

    /**
     * Livewire mount hook
     *
     * @return void
     */
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

    /**
     * Runs on every request, immediately after the component is instantiated,
     * but before any other lifecycle methods are called
     */
    public function boot(): void
    {
        $this->{$this->table_name} = [
            'sorts' => $this->{$this->table_name}['sorts'] ?? [],
            'filters' => $this->{$this->table_name}['filters'] ?? [],
            'columns' => $this->{$this->table_name}['columns'] ?? [],
        ];
    }

    /**
     * Render table
     *
     * @return void
     */
    public function render()
    {
        $this->setupQueryBuilder();

        return view('livewire.datatable.table', [
            'table' => $this,
            'items' => $this->getItems(),
        ]);
    }
}
