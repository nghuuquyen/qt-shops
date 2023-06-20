<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;

abstract class Form extends Component
{
    public mixed $data = null;

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
    abstract public function getAction(mixed $data): string;

    /**
     * Get form request method. This is request method for Laravel Router
     *
     * @return void
     */
    abstract public function getMethod(mixed $data): string;

    /**
     * Get form method
     *
     * @return void
     */
    public function getFormMethod()
    {
        return $this->getMethod($this->getData()) == 'GET' ? 'GET' : 'POST';
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
     * Component mount
     *
     * @return void
     */
    public function mount(mixed $data = null)
    {
        $this->data = $data;
    }

    /**
     * Setup and return fields data
     *
     * @return array
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
