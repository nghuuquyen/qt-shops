<?php

namespace App\Http\Livewire\Roles;

use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Table;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class RoleTable extends Table
{
    protected function getColumns(): array
    {
        return [
            TextColumn::make('Name', 'name')
                ->format(fn ($value) => Str::headline($value))
                ->searchable(),

            TextColumn::make('Last Updated', 'updated_at'),

            LinkColumn::make('Action')
                ->value(function ($role) {
                    $links = [];

                    if (auth()->user()->can('view', $role)) {
                        $links[] = [
                            'title' => 'View',
                            'value' => route('roles.show', ['role' => $role->id]),
                        ];
                    }

                    if (auth()->user()->can('update', $role)) {
                        $links[] = [
                            'title' => 'Edit',
                            'value' => route('roles.edit', ['role' => $role->id]),
                        ];
                    }

                    return $links;
                }),
        ];
    }

    protected function getQuery(): Builder
    {
        return Role::query();
    }
}
