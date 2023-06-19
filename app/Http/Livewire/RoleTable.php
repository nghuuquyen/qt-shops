<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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

                    if (auth()->user()->can('view roles')) {
                        $links[] = [
                            'title' => 'View',
                            'value' => route('roles.show', ['role' => $role->id]),
                        ];
                    }

                    if (auth()->user()->can('update roles')) {
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
