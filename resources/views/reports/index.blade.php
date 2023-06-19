@extends('layouts.admin')

@section('page_title')
    {{ __('Reports') }}
@endsection

@section('page_action')
    @can('create reports')
        <div class="flex flex-row justify-end">
            <x-button href="{{ route('reports.create') }}" target="_self" icon="plus" class="text-base font-normal">
                {{ __('Create') }}
            </x-button>
        </div>
    @endcan
@endsection

@section('main')
    <section>
        <x-panel icon="cube">
            <livewire:report-table />
        </x-panel>
    </section>
@endsection
