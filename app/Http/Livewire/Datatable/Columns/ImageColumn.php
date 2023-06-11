<?php

namespace App\Http\Livewire\Datatable\Columns;

use Closure;

class ImageColumn extends Column
{
    protected $width = 50;

    protected $height = 50;

    public function __construct(string $title, string $from = null)
    {
        parent::__construct($title, $from);
    }

    public function size($width, $height)
    {
        $this->width = $width;
        $this->height = $height;

        return $this;
    }

    public function getView()
    {
        return 'livewire.datatable.cells.image';
    }

    public function getData($row_item)
    {
        $src = $this->getCellValue($row_item);

        if ($this->hasFormatter()) {
            $src = ($this->getFormatter())($src);
        }

        return [
            'src' => $src,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
}
