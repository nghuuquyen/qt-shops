<x-admin-layout>
    <x-slot name="page_title">
        {{ $product->name }}
    </x-slot>

    <x-slot name="page_action">
        <div class="flex flex-row justify-end -mx-5">
            <x-button icon="arrow-uturn-left" href="{{ route('products.show', ['product' => $product->id]) }}"
                target="_self"
                class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                {{ __('Back to view') }}
            </x-button>
        </div>
    </x-slot>

    <x-slot name="main">
        <section>
            <x-panel>
                <livewire:products.product-form :data="$product" mode="edit" />
            </x-panel>
        </section>
    </x-slot>
</x-admin-layout>
