<?php

namespace App\Http\Livewire;

use Livewire\Component;

abstract class DataTable extends Component
{
    const IMAGE_COLUMN = 'IMAGE';

    const TEXT_COLUMN = 'TEXT';

    const LINK_COLUMN = 'LINK';

    const ACTION_COLUMN = 'ACTION';

    abstract protected function getColumns();

    abstract protected function getQuery();

    protected function getActions()
    {
        return [];
    }

    public function render()
    {
        $columns = $this->getColumns();

        $items = $this->getQuery()->paginate(5);

        return view('livewire.data-table', compact('columns', 'items'));
    }
}
