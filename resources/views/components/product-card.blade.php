<div class="flex flex-row bg-white p-2 w-full cursor-pointer hover:shadow-xl">
    <div class="flex-shrink-0">
        <img class="object-cover h-24 w-24" src="{{ $product['thumnail_url'] }}" alt="product image" />
    </div>
    <div class="flex flex-col ml-4 w-full">
        <h2 class="text-base font-bold text-black">{{ $product['name'] }}</h2>
        <p class="mt-3 text-sm">{{ $product['description'] }}</p>
        <div class="flex flex-row justify-between mt-3">
            <span class="text-black font-bold text-sm">
                {{ number_format($product['price']) }} {{ $product['currency'] }}
            </span>

            <button class="flex flex-row text-violet-800 active:translate-y-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <span class="ml-2">Select</span>
            </button>
        </div>
    </div>
</div>