<?php

namespace App\Http\Livewire\Datatable\Columns;

use Illuminate\View\View;

class TextColumn extends Column
{
    /**
     * Get view data
     *
     * @param mixed $row_item
     * @return mixed
     */
    public function getData(mixed $row_item): mixed
    {
        $value = $this->getCellValue($row_item);

        if ($this->hasFormatter()) {
            $value = ($this->getFormatter())($value);
        }

        return [
            'value' => $value,
        ];
    }

    public function render(mixed $row_item): View
    {
        return view('livewire.datatable.cells.text', $this->getData($row_item));
    }
}
