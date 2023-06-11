<?php

namespace App\Http\Livewire\Datatable;

use Livewire\Component;

class Filter extends Component
{
    protected $filter;

    public $value;

    public function mount($filter)
    {
        $this->filter = $filter;
    }

    public function updatedValue($value)
    {
        $this->emit('FILTER_CHANGE', $this, $value);
    }

    public function render()
    {
        $view = $this->filter->getView();

        $data = $this->filter->getData();
        
        return view($view, $data);
    }
}
