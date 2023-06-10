<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;

class Cell extends Component
{
    protected $column;

    public $item;

    public function mount($column, $item)
    {
        $this->column = $column;
        $this->item = $item;
    }

    public function render()
    {
        $view = $this->column->getView();

        $data = $this->column->getData($this->item);

        return view($view, $data);
    }
}
