<?php

namespace App\Http\Livewire\Forms\Fields\Traits;

use App\Http\Livewire\Forms\Fields\Field;
use App\Http\Livewire\Forms\Form;

trait WithColumnVisibility
{
    public bool $hide_on_create = false;

    public bool $hide_on_view = false;

    public bool $hide_on_edit = false;

    /**
     * Hide field on create
     */
    public function hideOnCreate(): Field
    {
        $this->hide_on_create = true;

        return $this;
    }

    /**
     * Check is hide on create or not
     */
    public function isHideOnCreate(): bool
    {
        return $this->hide_on_create;
    }

    /**
     * Hide field on create
     */
    public function hideOnView(): Field
    {
        $this->hide_on_view = true;

        return $this;
    }

    /**
     * Check is hide on view or not
     */
    public function isHideOnView(): bool
    {
        return $this->hide_on_view;
    }

    /**
     * Hide field on edit
     */
    public function hideOnEdit(): Field
    {
        $this->hide_on_edit = true;

        return $this;
    }

    /**
     * Check is hide on view or not
     */
    public function isHideOnEdit(): bool
    {
        return $this->hide_on_edit;
    }

    /**
     * Get is field visible on screen or not
     */
    public function isVisible(): bool
    {
        switch ($this->getForm()->getMode()) {
            case Form::MODE_CREATE:
                return ! $this->isHideOnCreate();

            case Form::MODE_VIEW:
                return ! $this->isHideOnView();

            case Form::MODE_EDIT:
                return ! $this->isHideOnEdit();
        }
    }
}
