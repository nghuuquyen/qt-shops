@extends('layouts.base')

@section('main')
    <section class="p-4 mt-6 px-2 py-2 lg:px-24">
        <form method="POST" action="{{ route('checkout.store') }}">
            @csrf

            <div class="flex flex-row justify-end mb-3">
                <a href="/" class="flex flex-row items-center text-gray-500">
                    <span class="mr-2">Continue to shopping</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5">

                {{-- left column --}}
                <div class="col-span-3 grid grid-cols-1 gap-4">
                    {{-- shippting information form --}}
                    <x-panel icon="identification" header="Shipping Address">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="grid grid-cols-2 gap-4">
                                <x-text-input label="Your name" name="full_name" value="{{ old('full_name') }}"
                                    placeholder="Please enter your name" />
                                <x-text-input label="Phone number" name="phone_number" value="{{ old('phone_number') }}"
                                    placeholder="Please enter your phone number" />
                            </div>

                            <x-text-input label="Your email" name="email" value="{{ old('email') }}"
                                placeholder="Please enter your email address" />
                            <x-text-input label="Shipping address" name="shipping_address"
                                value="{{ old('shipping_address') }}" placeholder="Please enter your address" />
                            <x-text-input label="Notes" name="notes" value="{{ old('notes') }}"
                                placeholder="Please enter your note if any" />
                        </div>
                    </x-panel>

                    {{-- cart items --}}
                    <x-panel icon="shopping-cart" header="Cart Items">
                        <ul>
                            @foreach ($cart->items as $item)
                                <li class="border-b-2 py-4 flex flex-row">
                                    <div class="flex-shrink-0">
                                        <img class="object-cover h-20 w-20 rounded"
                                            src="{{ $item->product->display_image_url }}?w=150&h=150" alt="product image" />
                                    </div>

                                    <div class="flex flex-col ml-2 grow">
                                        <h2 class="text-base text-black"> {{ $item->quantity }}x {{ $item->product->name }}
                                        </h2>
                                        <p class="mt-2 text-sm text-gray-500">{{ $item->notes }}</p>
                                    </div>

                                    <div class="flex-shrink-0">
                                        <span class="text-black font-bold text-base">
                                            {{ $item->product->getFormattedTotalAmount($item->quantity) }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </x-panel>
                </div>

                {{-- right column --}}
                <div class="col-span-2 mt-4 lg:mt-0 lg:pl-6">
                    <x-panel header="Payments" icon="banknotes" class="sticky top-0">

                        <x-text-input label="Coupon" name="coupon_code" value="{{ old('email') }}"
                            placeholder="Please enter your coupon code" />

                        <ul>
                            <li class="flex flex-row items-center justify-between mt-4 lg:mt-8">
                                <span class="text-lg text-gray-500">Subtotal</span>

                                <span class="text-base">
                                    {{ number_format($cart->total_amount) }} {{ $cart->currency }}
                                </span>
                            </li>

                            <li class="flex flex-row items-center justify-between mt-4 lg:mt-8">
                                <span class="text-lg text-gray-500">Shipping Fee</span>

                                <span class="text-base">
                                    free
                                </span>
                            </li>

                            <li class="flex flex-row items-center justify-between mt-4 lg:mt-8">
                                <span class="text-lg text-gray-500">Total</span>

                                <span class="text-2xl font-bold">
                                    {{ number_format($cart->total_amount) }} {{ $cart->currency }}
                                </span>
                            </li>
                        </ul>

                        <x-button class="grow w-full mt-6" type="submit" icon="credit-card">
                            Send Order
                        </x-button>
                    </x-panel>
                </div>
            </div>
        </form>
    </section>

    {{-- add more space for avoid cart bar override content --}}
    <div class="w-full min-h-[50px]"></div>
@endsection
