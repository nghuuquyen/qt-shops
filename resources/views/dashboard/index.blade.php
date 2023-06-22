<x-admin-layout>
    <x-slot name="page_title">
        {{ __('Dashboard') }}
    </x-slot>

    <x-slot name="page_action">
        <div class="flex flex-row justify-end">
            <div class="flex flex-row">
                <x-dropdown title="{{ __('Last 07 Days: 2023-06-10 ~ 2023-06-17') }}" icon="calendar-days">
                    <div class="w-full grid grid-cols-1 gap-4">
                        <ul class="w-full text-on-surface-600 text-center">
                            <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">Today</li>
                            <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">Yesterday</li>
                            <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">This week</li>
                            <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">This month</li>
                        </ul>
                    </div>
                </x-dropdown>
            </div>
        </div>
    </x-slot>

    <x-slot name="main">
        <section class="relative grid grid-cols-1 gap-6">
            <x-panel>
                <div class="grid grid-cols-1 gap-6">
                    {{-- row --}}
                    <div class="grid grid-cols-1 md:grid-cols-5">
                        {{-- column metrics --}}
                        <div class="grid grid-cols-2 gap-4 col-span-2 h-fit mb-5 md:mb-0">
                            <div class="p-4 bg-surface-800 flex flex-col rounded items-center justify-center h-24">
                                <span class="font-normal text-base text-on-surface-500 mb-2 w-full">Orders</span>
                                <span class="font-bold text-xl text-on-surface-50 w-full">150</span>
                            </div>
                            <div class="p-4 bg-surface-800 flex flex-col rounded items-center justify-center h-24">
                                <span class="font-normal text-base text-on-surface-500 mb-2 w-full">Revenues</span>
                                <span class="font-bold text-xl text-on-surface-50 w-full">8,000,000 VNĐ</span>
                            </div>
                            <div class="p-4 bg-surface-800 flex flex-col rounded items-center justify-center h-24">
                                <span class="font-normal text-base text-on-surface-500 mb-2 w-full">Customers</span>
                                <span class="font-bold text-xl text-on-surface-50 w-full">120</span>
                            </div>
                            <div class="p-4 bg-surface-800 flex flex-col rounded items-center justify-center h-24">
                                <span class="font-normal text-base text-on-surface-500 mb-2 w-full">Average
                                    Spend</span>
                                <span class="font-bold text-xl text-on-surface-50 w-full">250,000 VNĐ</span>
                            </div>
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
                <livewire:orders.order-table />
            </x-panel>
        </section>
    </x-slot>
</x-admin-layout>
