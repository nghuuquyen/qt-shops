<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;

abstract class Table extends Component
{
    abstract protected function getColumns();

    abstract protected function getQuery();

    public function render()
    {
        $columns = $this->getColumns();

        $items = $this->getQuery()->paginate(5);

        return view('livewire.datatable.table', compact('columns', 'items'));
    }
}
