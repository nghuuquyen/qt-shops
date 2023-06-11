<?php

namespace App\Http\Livewire\Datatable\Columns;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class Column
{
    public $title;

    public $field;

    protected $relations;

    protected $formatter;

    protected $searchable = false;

    protected $search_callback;

    public $display = true;

    abstract public function getView();

    abstract public function getData($row_item);

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

    public function format($callable)
    {
        $this->formatter = $callable;

        return $this;
    }

    public function hasFormatter()
    {
        return $this->formatter instanceof Closure;
    }

    public function getFormatter()
    {
        return $this->formatter;
    }

    public function searchable()
    {
        $this->searchable = true;

        return $this;
    }

    public function search($callable)
    {
        $this->search_callback = $callable;

        return $this;
    }

    public function isSearchable()
    {
        return $this->searchable;
    }

    public function hasSearchCallback()
    {
        return $this->search_callback != null;
    }

    public function getSearchCallback()
    {
        return $this->search_callback;
    }

    public function getColumn()
    {
        if ($this->relations) {
            return implode('.', $this->relations).'.'.$this->field;
        }

        return $this->field;
    }

    public function getCellValue($row_item)
    {
        return Arr::get($row_item, $this->getColumn());
    }

    public static function make(string $title, string $from = null): Column
    {
        return new static($title, $from);
    }
}
