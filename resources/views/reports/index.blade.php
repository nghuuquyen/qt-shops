@extends('layouts.admin')

@section('page_title')
    {{ __('Reports') }}
@endsection

@section('page_action')
    @can('create', \App\Models\Report::class)
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
            <livewire:reports.report-table />
        </x-panel>
    </section>
@endsection
