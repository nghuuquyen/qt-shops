<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Livewire\Datatable\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;
use App\Http\Livewire\Datatable\Columns\ImageColumn;
use App\Http\Livewire\Datatable\Filters\SelectFilter;

class RoleTable extends Table
{
    protected function getColumns(): array
    {
        return [
            TextColumn::make('Name', 'name')
                ->format(fn($value) => Str::headline($value))
                ->searchable(),

            TextColumn::make('Last Updated', 'updated_at'),

            LinkColumn::make('Action')
                ->value(fn ($role) => [
                    [
                        'title' => 'View',
                        'value' => route('roles.show', ['role' => $role->id]),
                    ],
                    [
                        'title' => 'Edit',
                        'value' => route('roles.edit', ['role' => $role->id]),
                    ],
                ]),
        ];
    }

    protected function getQuery(): Builder
    {
        return Role::query();
    }
}
