<x-offcanvas>
    @if (isset($product['id']))
    <x-slot:title>
        {{ $product['name'] }}
    </x-slot>

    <x-slot:body>
        <div class="grid gird-cols-1 gap-6">
            <img class="object-cover w-full h-64" src="{{ $product['image_url'] }}?w=600" alt="product image" />
        
            <span class="text-black text-3xl font-bold">
                {{ number_format($product['price']) }} {{ $product['currency'] }}
            </span>

            <p class="overflow-y-auto max-h-32 text-gray-500">
                {{ $product['description'] }}
            </p> 
        </div>

        <div>
            <div class="flex flex-col">
                <label class="font-bold mb-2">Special instructions</label>
                <input class="border px-2 py-4" type="text" placeholder="Ex. No opnions please" wire:model="notes" />
            </div>

            <div class="flex flex-row items-center mt-4">
                <div class="w-1/3 grid grid-cols-3">
                    <button class="active:translate-y-1" wire:click="decrement">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M3.75 12a.75.75 0 01.75-.75h15a.75.75 0 010 1.5h-15a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>                                      
                    </button>

                    <span class="text-3xl font-bold"> {{ $quantity }}</span>

                    <button class="active:translate-y-1" wire:click="increment">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                        </svg>                                      
                    </button>
                </div>

                <x-submit-button class="grow" wire:click="addCartItem">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
        
                    <span class="ml-2">
                        Add to cart   {{ number_format($product['price'] * $quantity) }} {{ $product['currency'] }}
                    </span>
                </x-submit-button>
            </div>
        </div>
    </x-slot>
    @endif
</x-offcanvas>