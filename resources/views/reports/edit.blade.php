@extends('layouts.admin')

@section('page_title')
    {{ $report->title }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end -mx-5">
        <x-button icon="arrow-uturn-left" href="{{ route('reports.show', ['report' => $report->id]) }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to view') }}
        </x-button>
    </div>
@endsection

@section('main')
    <section>
        <x-panel>
            <livewire:reports.report-form :data="$report" mode="edit" />
        </x-panel>
    </section>
@endsection
