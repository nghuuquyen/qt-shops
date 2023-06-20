<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

abstract class Form extends Component
{
    public const MODE_VIEW = 'view';

    public const MODE_CREATE = 'create';

    public const MODE_EDIT = 'edit';

    public mixed $data = null;

    public string $mode = 'create';

    /**
     * Form method
     */
    protected string $method = 'POST';

    /**
     * Get form fields
     */
    abstract public function getFields(): array;

    /**
     * Get form action
     */
    abstract public function getAction(mixed $data, string $mode): string;

    /**
     * Get form request method. This is request method for Laravel Router
     *
     * @return void
     */
    abstract public function getMethod(mixed $data, string $mode): string;

    /**
     * Get form method
     *
     * @return void
     */
    public function getFormMethod()
    {
        return $this->getMethod($this->getData(), $this->getMode()) == 'GET' ? 'GET' : 'POST';
    }

    /**
     * Is has data binding to form
     */
    public function hasData(): bool
    {
        return $this->data !== null;
    }

    /**
     * Get form data
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * Get mode
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * Check is view mode or not
     */
    public function isViewMode(): bool
    {
        return $this->mode == self::MODE_VIEW;
    }
    
    /**
     * Check is edit mode or not
     */
    public function isEditMode(): bool
    {
        return $this->mode == self::MODE_EDIT;
    }

    /**
     * Check is create mode or not
     */
    public function isCreateMode(): bool
    {
        return $this->mode == self::MODE_CREATE;
    }

    /**
     * Component mount
     *
     * @return void
     */
    public function mount(mixed $data = null, $mode = 'create')
    {
        $this->data = $data;
        $this->mode = $mode;
    }

    /**
     * Setup and return fields data
     */
    public function setupFields(): array
    {
        $fields = $this->getFields();

        foreach ($fields as $field) {
            $field->setForm($this);
        }

        return $fields;
    }

    /**
     * Render table
     *
     * @return void
     */
    public function render()
    {
        $fields = $this->setupFields();

        return view('livewire.forms.form', [
            'form' => $this,
            'fields' => $fields,
        ]);
    }
}
