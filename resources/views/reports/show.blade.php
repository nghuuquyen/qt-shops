@extends('layouts.admin')

@section('page_title')
    {{ $report->title }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button icon="arrow-uturn-left" href="{{ route('reports.index') }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to list') }}
        </x-button>

        @can('create', \App\Models\Report::class)
            <form method="POST" action="{{ route('reports.report-files.store', ['report' => $report->id]) }}">
                @csrf

                <x-button type="submit" target="_self" icon="arrow-path"
                    class="text-base font-normal bg-[#ef933d] hover:bg-[#ffa755]">
                    {{ __('Generate Report File') }}
                </x-button>
            </form>
        @endcan

        @can('update', $report)
            <x-button href="{{ route('reports.edit', ['report' => $report->id]) }}" target="_self" icon="edit"
                class="text-base font-normal ml-2">
                {{ __('Edit') }}
            </x-button>
        @endcan
    </div>
@endsection

@section('main')
    <section class="relative grid grid-cols-1 gap-6">
        <x-panel icon="cube" header="{{ __('Informations') }}">

            <livewire:reports.report-form :data="$report" mode="view" />

            @can('delete', $report)
                <form method="POST" action="{{ route('reports.destroy', ['report' => $report->id]) }}" class="mt-5 -mr-5">
                    @csrf
                    @method('DELETE')

                    <div class="flex flex-row justify-end">
                        <x-button icon="trash" type="submit"
                            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                            {{ __('Remove this item') }}
                        </x-button>
                    </div>
                </form>
            @endcan
        </x-panel>

        <x-panel icon="cube" header="{{ __('Report Files') }}">
            <livewire:reports.report-file-table :report="$report" />
        </x-panel>
    </section>
@endsection
