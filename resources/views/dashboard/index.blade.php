<x-admin-layout>
    <x-slot name="page_title">
        {{ __('Dashboard') }}
    </x-slot>

    <x-slot name="page_action">
        <div class="flex flex-row justify-end">
           <livewire:dashboard.date-range-picker />
        </div>
    </x-slot>

    <x-slot name="main">
        <section class="relative grid grid-cols-1 gap-6">
            <x-panel>
                <div class="grid grid-cols-1">
                    {{-- row --}}
                    <div class="grid grid-cols-1 md:grid-cols-5">
                        {{-- column metrics --}}
                        <div class="col-span-2 mb-5 md:mb-0">
                            <livewire:dashboard.sale-metrics />
                        </div>

                        {{-- columns pie charts --}}
                        <div class="grid grid-cols-2 col-span-3">
                            <livewire:dashboard.order-product-category-pie-chart />

                            <livewire:dashboard.order-customer-pie-chart />
                        </div>
                    </div>

                    {{-- row --}}
                    <livewire:dashboard.order-line-chart />
                </div>
            </x-panel>

            <x-panel>
                <livewire:dashboard.recent-order-table />
            </x-panel>
        </section>
    </x-slot>
</x-admin-layout>
