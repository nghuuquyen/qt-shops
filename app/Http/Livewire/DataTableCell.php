<?php

namespace App\Http\Livewire;

use Closure;
use Livewire\Component;

class DataTableCell extends Component
{
    public $column;

    public $item;

    public function mount($column, $item)
    {
        $this->column = $column;
        $this->item = $item;
    }

    public function render()
    {
        $view = null;

        $data = [];

        switch ($this->column['type']) {

            case DataTable::IMAGE_COLUMN:

                $src = $this->item[$this->column['field']];

                if (isset($this->column['format'])) {
                    $src = $this->column['format']($src);
                }

                return view('components.datatable.cells.image', [
                    'src' => $src,
                ]);

            case DataTable::LINK_COLUMN:

                $href = $this->column['value'];

                if ($href instanceof Closure) {
                    $href = $href($this->item);
                }

                return view('components.datatable.cells.link', [
                    'title' => $this->column['title'],
                    'href' => $href,
                ]);

            case DataTable::TEXT_COLUMN:
                return view('components.datatable.cells.text', [
                    'value' => $this->item[$this->column['field']],
                ]);
        }

        throw new Exception('Do not support cell type '.$this->column['type']);
    }
}
