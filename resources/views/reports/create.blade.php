<x-admin-layout>
    <x-slot name="page_title">
        {{ __('Create New') }}
    </x-slot>

    <x-slot name="page_action">
        <div class="flex flex-row justify-end">
            <x-button icon="arrow-uturn-left" href="{{ route('reports.index') }}" target="_self"
                class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                {{ __('Back to list') }}
            </x-button>
        </div>
    </x-slot>

    <x-slot name="main">
        <section>
            <x-panel>
                <livewire:reports.report-form />
            </x-panel>
        </section>
    </x-slot>
</x-admin-layout>
