<x-admin-layout>
    <x-slot name="page_title">
        {{ __('Products') }}
    </x-slot>

    <x-slot name="page_action">
        <div class="flex flex-row justify-end">
            @can('create', App\Models\Product::class)
                <x-button href="{{ route('products.create') }}" target="_self" icon="plus" class="text-base font-normal">
                    {{ __('Create') }}
                </x-button>
            @endcan
        </div>
    </x-slot>

    <x-slot name="main">
        <section>
            <x-panel icon="cube">
                <livewire:products.product-table />
            </x-panel>
        </section>
    </x-slot>
</x-admin-layout>
