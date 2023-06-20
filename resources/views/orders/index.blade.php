<x-admin-layout>
    <x-slot name="page_title">
        {{ __('Orders') }}
    </x-slot>

    <x-slot name="main">
        <section>
            <x-panel icon="cube">
                <livewire:orders.order-table />
            </x-panel>
        </section>
    </x-slot>
</x-admin-layout>
