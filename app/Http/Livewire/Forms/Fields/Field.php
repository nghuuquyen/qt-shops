<?php

namespace App\Http\Livewire\Forms\Fields;

use Closure;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use App\Http\Livewire\Forms\Form;
use App\Http\Livewire\Forms\Fields\Traits\WithColumnVisibility;

abstract class Field
{
    use WithColumnVisibility;

    const DEFAULT_TYPE = 'text';

    public ?string $name = null;

    public ?string $type = null;

    public ?string $label = null;

    public ?string $placeholder = null;

    public bool $readonly = false;

    public ?string $model = null;

    public ?string $value = null;

    public ?Form $form = null;

    public ?Closure $suffix = null;

    public bool $explode_as_tags = false;

    /**
     * Construct
     */
    public function __construct(?string $name, ?string $label)
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Make column instance
     */
    public static function make(?string $name, ?string $label): Field
    {
        return new static($name, $label);
    }

    /**
     * Set placeholder
     */
    public function placeholder(?string $placeholder): Field
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Set model
     */
    public function model(?string $model): Field
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set type
     */
    public function type(?string $type): Field
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set suffix
     */
    public function suffix(Closure $suffix): Field
    {
        $this->suffix = $suffix;

        return $this;
    }

    /**
     * Set readonly
     */
    public function readonly(bool $readonly = false): Field
    {
        $this->readonly = $readonly;

        return $this;
    }

    /**
     * Check has suffix or not
     */
    public function hasSuffix(): bool
    {
        return $this->suffix != null;
    }

    /**
     * Get suffix
     */
    public function getSuffix(): string
    {
        if (! $this->suffix) {
            return '';
        }

        return ($this->suffix)($this->getForm()->getData(), $this->getForm()->getMode());
    }

    /**
     * Get type
     */
    public function getType(): string
    {
        return $this->type ?? self::DEFAULT_TYPE;
    }

    /**
     * Check has name or not
     */
    public function hasName(): bool
    {
        return $this->name != null;
    }

    /**
     * Get name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Check has label or not
     */
    public function hasLabel(): bool
    {
        return $this->label != null;
    }

    /**
     * Get label
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Get placeholder
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder ?? 'Please input this field';
    }

    /**
     * Check has model or not
     */
    public function hasModel(): bool
    {
        return $this->model != null;
    }

    /**
     * Get model for Livewire
     */
    public function getModel(): ?string
    {
        return $this->model;
    }

    /**
     * Is readonly
     */
    public function isReadonly(): bool
    {
        return $this->readonly;
    }

    /**
     * Set form
     */
    public function setForm(Form $form): void
    {
        $this->form = $form;
    }

    /**
     * Get form
     *
     * @param  Form  $form
     * @return void
     */
    public function getForm(): ?Form
    {
        return $this->form;
    }

    /**
     * Get field value
     */
    public function getFieldValue(): mixed
    {
        return Arr::get($this->getForm()->getData(), $this->getName());
    }

    /**
     * Check has value or not
     */
    public function hasValue(): bool
    {
        return $this->form && $this->getFieldValue() != null;
    }

    /**
     * On view mode display data as tags format
     */
    public function onViewExplodeAsTags(): Field
    {
        $this->explode_as_tags = true;

        return $this;
    }

    /**
     * Check is explode as tags on view or not
     */
    public function isExplodeAsTags(): bool
    {
        return $this->explode_as_tags;
    }

    /**
     * Get value
     */
    public function getValue(): ?string
    {
        return $this->getFieldValue();
    }

    /**
     * Render field view
     */
    abstract public function render(Form $form): View;
}
