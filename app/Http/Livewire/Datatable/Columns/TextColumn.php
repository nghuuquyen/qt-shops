<?php

namespace App\Http\Livewire\Datatable\Columns;

class TextColumn extends Column
{
    public function __construct(string $title, string $from = null)
    {
        parent::__construct($title, $from);
    }

    public function getView()
    {
        return 'livewire.datatable.cells.text';
    }

    public function getData($row_item)
    {
        $value = $row_item[$this->field];

        return [
            'value' => $value,
        ];
    }
}
