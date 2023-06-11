<?php

namespace App\Http\Livewire\Datatable\Columns;

use Closure;

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

    public function getView(): string
    {
        return 'livewire.datatable.cells.link';
    }

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
}
