<?php

namespace App\Http\Livewire\Datatable\Columns;

use Illuminate\Support\Str;

abstract class Column
{
    public $title;

    public $field;

    protected $relations;

    protected $formatter;

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

    abstract public function getView();

    abstract public function getData($row_item);

    /**
     * @return static
     */
    public static function make(string $title, string $from = null): Column
    {
        return new static($title, $from);
    }
}
