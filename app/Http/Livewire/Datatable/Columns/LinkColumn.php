<?php

namespace App\Http\Livewire\Datatable\Columns;

use Closure;
use Illuminate\View\View;

class LinkColumn extends Column
{
    /**
     * Link href
     *
     * @var Closure|null
     */
    protected ?Closure $href = null;

    /**
     * Set get value callback
     *
     * @param Closure $callable
     * @return void
     */
    public function value(Closure $callable): LinkColumn
    {
        $this->href = $callable;

        return $this;
    }

    /**
     * Get view data
     *
     * @param mixed $row_item
     * @return mixed
     */
    public function getData(mixed $row_item): mixed
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

    public function render(mixed $row_item): View
    {
        return view('livewire.datatable.cells.link', $this->getData($row_item));
    }
}
