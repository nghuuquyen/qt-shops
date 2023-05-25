@extends('layouts.base')

@section('main')
    <section class="p-4 mt-6">
        <div class="grid grid-cols-1 lg:grid-cols-5">
            {{-- left column --}}
            <div class="col-span-3 grid grid-cols-1 gap-4 bg-white p-6 lg:border-r-4 rounded-lg">
                <h1 class="text-2xl border-b pb-3 mb-2 flex flex-row items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                    </svg>

                    <span class="ml-2">Shipping Address</span>
                </h1>

                <div class="grid grid-cols-2 gap-4">
                    <x-text-input label="Your name" model="name" placeholder="Please enter your name" />
                    <x-text-input label="Phone number" model="phone_number" placeholder="Please enter your phone number" />    
                </div>

                <x-text-input label="Your email" model="email" placeholder="Please enter your email address" />
                <x-text-input label="Shipping address" model="address" placeholder="Please enter your address" />
                <x-text-input label="Notes" model="notes" placeholder="Please enter your note if any" />

                <div class="flex flex-row justify-end">
                    <a href="/" class="flex flex-row items-center text-gray-600">
                        <span class="mr-2">Continue to shopping</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- right column --}}
            <div class="col-span-2 mt-4 lg:mt-0 lg:pl-6">
                <div>
                    <ul>
                        @foreach ($cart['items'] as $item)
                            <li class="border-b-2 py-4 flex flex-row">
                                <div class="flex-shrink-0">
                                    <img class="object-cover h-20 w-20 rounded" src="{{ $item['image_url'] }}?w=150&h=150" alt="product image" />
                                </div>
    
                                <div class="flex flex-col ml-2">
                                    <h2 class="text-base text-black"> {{ $item['quantity'] }}x {{ $item['name'] }}</h2>
                                    <p class="mt-3 text-sm text-gray-500">{{ $item['description'] }}</p>
                                </div>
    
                                <div class="flex-shrink-0">
                                    <span class="text-black font-bold text-base">
                                        {{ number_format($item['price'] * $item['quantity']) }} {{ $item['currency'] }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                        <li class="flex flex-row items-center justify-between mt-4 lg:mt-8">
                            <span class="text-lg text-gray-500">Total</span>

                            <span class="text-2xl font-bold">
                                {{ number_format($cart['total_amount']) }} {{ $cart['currency'] }}
                            </span>
                        </li>
                    </ul>

                    <x-submit-button class="grow w-full mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
            
                        <span class="ml-2">
                           Confirm Checkout
                        </span>
                    </x-submit-button>
                </div>
            </div>
        </div>
    </section>
@endsection