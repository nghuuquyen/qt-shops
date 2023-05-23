<div x-data="{}" class="flex flex-row bg-white p-2 w-full cursor-pointer hover:shadow-xl" @click="$dispatch('offcanvas-ex')">
    <div class="flex-shrink-0">
        <img class="object-cover h-24 w-24" src="{{ $product['thumnail_url'] }}" alt="product image" />
    </div>
    <div class="flex flex-col ml-4 w-full">
        <h2 class="text-xl text-black">{{ $product['name'] }}</h2>
        <p class="mt-3 lg:mt-6 text-sm text-gray-500">{{ $product['description'] }}</p>
        <div class="flex flex-row justify-between mt-3 lg:mt-6">
            <span class="text-black font-bold text-sm">
                {{ number_format($product['price']) }} {{ $product['currency'] }}
            </span>

            <button class="flex flex-row text-green-800 active:translate-y-1 bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M12 3.75a.75.75 0 01.75.75v6.75h6.75a.75.75 0 010 1.5h-6.75v6.75a.75.75 0 01-1.5 0v-6.75H4.5a.75.75 0 010-1.5h6.75V4.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                </svg>                  
            </button>
        </div>
    </div>
</div>