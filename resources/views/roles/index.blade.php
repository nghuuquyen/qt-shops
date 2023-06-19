@extends('layouts.admin')

@section('page_title')
    {{ __('Roles') }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        @can('create roles')
            <x-button href="{{ route('roles.create') }}" target="_self" icon="plus" class="text-base font-normal">
                {{ __('Create') }}
            </x-button>
        @endcan
    </div>
@endsection

@section('main')
    <section>
        <x-panel icon="cube">
            <livewire:role-table />
        </x-panel>
    </section>
@endsection
