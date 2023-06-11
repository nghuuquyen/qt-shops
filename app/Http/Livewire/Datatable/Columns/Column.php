<?php

namespace App\Http\Livewire\Datatable\Columns;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\View;

abstract class Column
{
    /**
     * Column title
     */
    public ?string $title = null;

    /**
     * The field name that use to get data from database table
     */
    public ?string $field = null;

    /**
     * Store the relation to get data from nested column. for example if you get data
     * from "product.category.name" then the field is "name" and the relations is ['product', 'category']
     */
    protected array $relations = [];

    /**
     * Formatter function
     */
    protected Closure $formatter;

    /**
     * Is searchable columm
     */
    protected bool $searchable = false;

    /**
     * Search callback
     */
    protected Closure $search_callback;

    /**
     * Is display on screen or not
     */
    public bool $display = true;

    /**
     * Render cell view
     */
    abstract public function render(mixed $row_item): View;

    /**
     * Construct
     */
    public function __construct(string $title, string $from = null)
    {
        $this->title = trim($title);

        if ($from) {
            $this->from = trim($from);

            if (Str::contains($this->from, '.')) {
                $this->field = Str::afterLast($this->from, '.');
                $this->relations = explode('.', Str::beforeLast($this->from, '.'));
            } else {
                $this->field = $this->from;
            }
        } else {
            $this->field = Str::snake($title);
        }
    }

    /**
     * Set formatter
     *
     * @param [type] $callable
     */
    public function format(Closure $callable): Column
    {
        $this->formatter = $callable;

        return $this;
    }

    /**
     * Check has formatter or not
     */
    public function hasFormatter(): bool
    {
        return $this->formatter instanceof Closure;
    }

    /**
     * Get formatter
     */
    public function getFormatter(): Closure
    {
        return $this->formatter;
    }

    /**
     * Set searchable
     */
    public function searchable(): Column
    {
        $this->searchable = true;

        return $this;
    }

    /**
     * Set search callback
     *
     * @param [type] $callable
     */
    public function search($callable): Column
    {
        $this->search_callback = $callable;

        return $this;
    }

    /**
     * Check is searchable or not
     */
    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    /**
     * Check has search callback or not
     */
    public function hasSearchCallback(): bool
    {
        return $this->search_callback != null;
    }

    /**
     * Get search callback
     */
    public function getSearchCallback(): Closure
    {
        return $this->search_callback;
    }

    /**
     * Get column data path
     */
    public function getColumn(): string
    {
        if ($this->relations) {
            return implode('.', $this->relations).'.'.$this->field;
        }

        return $this->field;
    }

    /**
     * Get cell value
     */
    public function getCellValue(mixed $row_item): mixed
    {
        return Arr::get($row_item, $this->getColumn());
    }

    /**
     * Make column instance
     */
    public static function make(string $title, string $from = null): Column
    {
        return new static($title, $from);
    }
}
