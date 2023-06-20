<?php

namespace App\Http\Livewire\Users;

use App\Http\Livewire\Forms\Fields\CheckboxListField;
use App\Http\Livewire\Forms\Fields\InputField;
use App\Http\Livewire\Forms\Fields\TagsInputField;
use App\Http\Livewire\Forms\Form;
use App\Models\Permission;
use Illuminate\Support\Str;

class ProfileForm extends Form
{
    public function getMethod(mixed $user, string $mode): string
    {
        return 'PUT';
    }

    public function getAction(mixed $user, string $mode): string
    {
        return route('profile.update');
    }

    public function getFields(): array
    {
        return [
            TagsInputField::make('roles', 'Roles')
                ->values(fn (mixed $user) => $user->roles->pluck('name'))
                ->formatOptionLabel(fn ($text) => Str::title($text))
                ->hideOnEdit(),

            InputField::make('name', 'Name'),

            InputField::make('email', 'Email'),

            CheckboxListField::make('permissions', 'Permissions')
                ->options(fn () => Permission::all()
                    ->keyBy('name')
                    ->map(fn ($permission) => $permission->name)
                    ->toArray()
                )
                ->values(fn (mixed $user) => $user->getAllPermissions()->pluck('name'))
                ->formatOptionLabel(fn ($text) => Str::title($text))
                ->hideOnEdit(),
        ];
    }
}
