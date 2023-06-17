<?php

namespace App\Http\Livewire;

use App\Models\MailDelivery;
use App\Http\Livewire\Datatable\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Livewire\Datatable\Columns\LinkColumn;
use App\Http\Livewire\Datatable\Columns\TextColumn;

class MailDeliveryTable extends Table
{
    protected function getColumns(): array
    {
        return [
            TextColumn::make('Title', 'title')->searchable(),

            TextColumn::make('Created At', 'created_at'),

            TextColumn::make('Updated At', 'updated_at'),

            LinkColumn::make('Action')
                ->value(fn ($mail_delivery) => [
                    [
                        'title' => 'View',
                        'value' => route('mail-deliveries.show', ['mail_delivery' => $mail_delivery->id]),
                    ],
                    [
                        'title' => 'Edit',
                        'value' => route('mail-deliveries.edit', ['mail_delivery' => $mail_delivery->id]),
                    ],
                ]),
        ];
    }

    protected function getQuery(): Builder
    {
        return MailDelivery::query();
    }
}
