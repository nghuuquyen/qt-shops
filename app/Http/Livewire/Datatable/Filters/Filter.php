<?php

namespace App\Http\Livewire\Datatable\Filters;

use App\Http\Livewire\Datatable\Table;
use Illuminate\Support\Str;
use Illuminate\View\View;

abstract class Filter
{
    public $uuid;

    public $name;

    public $key;

    protected $relations;

    protected $filterCallback = null;

    public function __construct(string $name, string $key = null)
    {
        $this->name = $name;
        $this->key = $key ? $key : Str::snake($name);
    }

    /**
     * Do validate filter value is valid or not
     *
     * @param mixed $value
     * @return boolean
     */
    abstract public function validate(mixed $value): bool;

    /**
     * Get filter pill title
     *
     * @return string
     */
    abstract public function getFilterPillTitle(): string;

    /**
     * Get filter pull value
     *
     * @param mixed $value
     * @return string
     */
    abstract public function getFilterPillValue(mixed $value): string;

    /**
     * Render filter view
     *
     * @param Table $table
     * @return View
     */
    abstract public function render(Table $table): View;

    /**
     * Set filter
     *
     * @param callable $callback
     * @return Filter
     */
    public function filter(callable $callback): Filter
    {
        $this->filterCallback = $callback;

        return $this;
    }

    /**
     * Check has filter callback or not
     *
     * @return boolean
     */
    public function hasFilterCallback(): bool
    {
        return $this->filterCallback !== null;
    }

    /**
     * Get filter callback
     *
     * @return callable
     */
    public function getFilterCallback(): callable
    {
        return $this->filterCallback;
    }

    /**
     * Get filter key
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * Make filter instance
     *
     * @param string $title
     * @param string|null $from
     * @return Filter
     */
    public static function make(string $title,  string $key = null): Filter
    {
        return new static($title, $key);
    }
}
