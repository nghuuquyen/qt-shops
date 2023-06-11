<?php

namespace App\Http\Livewire\Datatable\Filters;

use Illuminate\Support\Str;
use App\Http\Livewire\Datatable\Table;

abstract class Filter 
{
    public $uuid;

    public $name;

    public $key;

    protected $relations;

    protected $filterCallback = null;

    abstract public function render(Table $table);

    public function __construct(string $name, string $key = null)
    {
        $this->name = $name;

        if ($key) {
            $this->key = $key;
        } else {
            $this->key = Str::snake($name);
        }
    }

    public function filter(callable $callback): Filter
    {
        $this->filterCallback = $callback;

        return $this;
    }

    public function hasFilterCallback(): bool
    {
        return $this->filterCallback !== null;
    }

    public function getFilterCallback(): callable
    {
        return $this->filterCallback;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public static function make(string $title, string $from = null): Filter
    {
        return new static($title, $from);
    }
}