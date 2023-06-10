<?php

namespace App\Http\Livewire\Datatable\Columns;

use Closure;

class LinkColumn extends Column
{
    protected $href;

    public function __construct(string $title)
    {
        parent::__construct($title);
    }

    public function value($callable)
    {
        $this->href = $callable;

        return $this;
    }

    public function getView()
    {
        return 'livewire.datatable.cells.link';
    }

    public function getData($row_item)
    {
        $href = $this->href;

        if ($href instanceof Closure) {
            $href = ($this->href)($row_item);
        }

        return [
            'title' => $this->title,
            'href' => $href,
        ];
    }
}
