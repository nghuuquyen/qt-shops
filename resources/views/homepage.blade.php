<x-user-layout>
    <x-slot name="navigation">
        <x-navigation :categories="$categories" />
    </x-slot>

    <x-slot name="main">
        @foreach ($categories as $category)
            <x-product-grids :category="$category" :products="$category['products']" />
        @endforeach

        {{-- add more space for avoid cart bar override content --}}
        <div class="w-full min-h-[150px]"></div>
    </x-slot>

    <x-slot name="components">
        <livewire:cart-bar />

        <livewire:add-cart-item-popup />
    </x-slot>
</x-user-layout>
