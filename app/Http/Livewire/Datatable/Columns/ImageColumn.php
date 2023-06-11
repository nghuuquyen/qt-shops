<?php

namespace App\Http\Livewire\Datatable\Columns;

use Closure;
use Illuminate\View\View;

class ImageColumn extends Column
{
    /**
     * Image width
     *
     * @var integer
     */
    protected int $width = 50;

    /**
     * Image height
     *
     * @var integer
     */
    protected int $height = 50;

    /**
     * Set widht and height
     *
     * @param integer $width
     * @param integer $height
     * @return ImageColumn
     */
    public function size(int $width, int $height): ImageColumn
    {
        $this->width = $width;
        $this->height = $height;

        return $this;
    }

    /**
     * Get view data
     *
     * @param mixed $row_item
     * @return mixed
     */
    public function getData(mixed $row_item): mixed
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
    
    /**
     * Render cell view
     *
     * @param mixed $row_item
     * @return View
     */
    public function render(mixed $row_item): View
    {
        return view('livewire.datatable.cells.image', $this->getData($row_item));
    }
}
