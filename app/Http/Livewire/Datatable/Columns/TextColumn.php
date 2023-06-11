<?php

namespace App\Http\Livewire\Datatable\Columns;

class TextColumn extends Column
{
    public function getView(): string
    {
        return 'livewire.datatable.cells.text';
    }

    public function getData(mixed $row_item): mixed
    {
        $value = $this->getCellValue($row_item);

        return [
            'value' => $value,
        ];
    }
}
