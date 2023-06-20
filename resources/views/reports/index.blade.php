<x-admin-layout>
    <x-slot name="page_title">
        {{ __('Reports') }}
    </x-slot>

    <x-slot name="page_action">
        @can('create', \App\Models\Report::class)
            <div class="flex flex-row justify-end">
                <x-button href="{{ route('reports.create') }}" target="_self" icon="plus" class="text-base font-normal">
                    {{ __('Create') }}
                </x-button>
            </div>
        @endcan
    </x-slot>

    <x-slot name="main">
        <section>
            <x-panel icon="cube">
                <livewire:reports.report-table />
            </x-panel>
        </section>
    </x-slot>
</x-admin-layout>
