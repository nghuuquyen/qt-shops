@extends('layouts.admin')

@section('page_title')
    {{ __('Reports') }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button href="{{ route('reports.create') }}" target="_self" icon="plus" class="text-base font-normal">
            {{ __('Create') }}
        </x-button>
    </div>
@endsection

@section('main')
    <section>
        <x-panel icon="cube">
            <livewire:report-table />
        </x-panel>
    </section>
@endsection
