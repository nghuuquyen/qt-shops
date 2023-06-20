<x-admin-layout>
    <x-slot name="page_title">
        {{ __('Customers') }}
    </x-slot>

    <x-slot name="main">
        <section>
            <x-panel icon="cube">
                <livewire:orders.customer-table />
            </x-panel>
        </section>
    </x-slot>
</x-admin-layout>
