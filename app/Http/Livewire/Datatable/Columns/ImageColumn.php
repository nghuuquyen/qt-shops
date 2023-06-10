<?php

namespace App\Http\Livewire\Datatable\Columns;

use Closure;

class ImageColumn extends Column
{
    public function __construct(string $title, string $from = null)
    {
        parent::__construct($title, $from);
    }

    public function getView()
    {
        return 'livewire.datatable.cells.image';
    }

    public function getData($row_item)
    {
        $src = $row_item[$this->field];

        if ($this->formatter instanceof Closure) {
            $src = ($this->formatter)($src);
        }

        return [
            'src' => $src,
        ];
    }
}
