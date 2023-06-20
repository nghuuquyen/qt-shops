<?php

namespace App\Http\Livewire\Roles;

use App\Models\Permission;
use Illuminate\Support\Str;
use App\Http\Livewire\Forms\Form;
use App\Http\Livewire\Forms\Fields\InputField;
use App\Http\Livewire\Forms\Fields\CheckboxListField;

class RoleForm extends Form
{
    public function getMethod(mixed $role, string $mode): string
    {
        return $mode == Form::MODE_EDIT ? 'PUT' : 'POST';
    }

    public function getAction(mixed $role, string $mode): string
    {
        return $mode == Form::MODE_EDIT
            ? route('roles.update', ['role' => $role->id])
            : route('roles.store');
    }

    public function getFields(): array
    {
        return [
            InputField::make('name', 'Name'),

            CheckboxListField::make('permissions', 'Permissions')
                ->options(fn () => Permission::all()
                    ->keyBy('name')
                    ->map(fn ($permission) => $permission->name)
                    ->toArray()
                )
                ->values(fn (mixed $role) => $role->permissions->pluck('name'))
                ->formatOptionLabel(fn ($text) => Str::title($text)),
        ];
    }
}
