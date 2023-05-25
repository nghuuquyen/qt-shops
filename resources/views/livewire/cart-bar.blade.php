<div 
    x-transition:enter="transition fade-in duration-300"
    x-transition:leave="transition fade-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-[100%]"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-[100%]"
    x-cloak x-data class="bg-white py-4 mt-6 fixed bottom-0 left-0 right-0 px-2 lg:px-0" x-show="$wire.cart.items.length > 0"
>
    <div class="max-w-screen-xl m-auto flex flex-col lg:flex-row lg:items-center">
        <div class="grow flex">
            <img src="/icons/cart-bag.svg" />

            <ul class="flex flex-wrap ml-2">
                @foreach ($cart['items'] as $item)
                    <li class="flex flex-row border rounded-lg px-2 py-1 mr-2 mt-2 cursor-pointer hover:bg-green-500 hover:text-white" @click="Livewire.emit('selectProduct', {{ $item['id'] }})">
                        <span class="mr-2">{{ $item['quantity'] }}x {{ $item['name'] }}</span>

                        <button class="cursor-pointer hover:text-red-600 active:translate-y-1 hover:rotate-90 ease-in duration-300" wire:click.stop="removeCartItem({{ $item['id'] }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>

        <x-submit-button class="mt-3 lg:mt-0" @click="window.location.href = '/checkout'">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
            </svg>

            <span class="ml-2">Checkout {{ number_format($cart['total_amount']) }} {{ $cart['currency'] ?? 'VNĐ' }}</span>
        </x-submit-button>
    </div>
</div>