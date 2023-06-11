<?php

namespace App\Http\Livewire\Datatable\Filters;

use Illuminate\Support\Str;

abstract class Filter 
{
    public $uuid;

    public $title;

    public $field;

    protected $relations;

    protected $filterCallback = null;

    abstract public function getView();

    abstract public function getData();

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

        $this->uuid = fake()->uuid();
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
        return $this->field;
    }

    public function getStoreKey(): string
    {
        return Str::of($this->title)->lower();
    }

    public static function make(string $title, string $from = null): Filter
    {
        return new static($title, $from);
    }
}