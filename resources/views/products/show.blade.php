<x-admin-layout>
    <x-slot name="page_title">
        {{ $product->name }}
    </x-slot>

    <x-slot name="page_action">
        <div class="flex flex-row justify-end">
            <x-button icon="arrow-uturn-left" href="{{ route('products.index') }}" target="_self"
                class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                {{ __('Back to list') }}
            </x-button>

            @can('update', $product)
                <x-button href="{{ route('products.edit', ['product' => $product->id]) }}" target="_self" icon="edit"
                    class="text-base font-normal">
                    {{ __('Edit') }}
                </x-button>
            @endcan
        </div>
    </x-slot>

    <x-slot name="main">
        <section class="relative">
            <x-panel>
                <livewire:products.product-form :data="$product" mode="view" />

                @can('delete', $product)
                    <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}"
                        class="mt-5 -mr-5">
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
        </section>
    </x-slot>
</x-admin-layout>
