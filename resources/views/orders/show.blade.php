@extends('layouts.base')

@section('main')
    <section class="mt-10 p-10 lg:mx-32 bg-white rounded-lg">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 lg:gap-8">
            {{-- first column --}}
            <div class="col-span-2 grid gird-cols-1 gap-6 lg:border-r-4">
                <h1 class="text-7xl text-gray-600">INVOICE</h1>

                <div class="flex flex-col">
                    <h2 class="text-sm font-bold text-gray-600">ORDER ID</h2>
                    <span class="text-xl">{{ $order->code }}</span>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-sm font-bold text-gray-600">ISSUE DATE</h2>
                    <span class="text-xl">{{ $order->created_at->format('Y-m-d') }} ({{ $order->created_at->diffForHumans() }})</span>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-sm font-bold text-gray-600">STATUS</h2>
                    <span class="text-xl">Processing</span>
                </div>
            </div>

            {{-- second column --}}
            <div class="col-span-3 grid gird-cols-1 gap-6">
                <div class="flex flex-col">
                    <h2 class="text-sm font-bold text-gray-600">FULL NAME</h2>
                    <span class="text-xl">{{ $order->full_name }}</span>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-sm font-bold text-gray-600">EMAIL ADDRESS</h2>
                    <span class="text-xl">{{ $order->email }}</span>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-sm font-bold text-gray-600">PHONE NUMBER</h2>
                    <span class="text-xl">{{ $order->phone_number }}</span>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-sm font-bold text-gray-600">SHIPPING ADDRESS</h2>
                    <span class="text-xl">{{ $order->shipping_address }}</span>
                </div>

                <div class="flex flex-col">
                    <h2 class="text-sm font-bold text-gray-600">NOTES</h2>
                    <span class="text-xl">{{ $order->notes }}</span>
                </div>
            </div>
        </div>

        <div>
            {{-- cart items table --}}
            <div class="relative overflow-x-auto mt-20">
                <table class="w-full text-xl text-left table-auto">
                    <thead class="text-sm font-bold text-gray-600 uppercase bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Product name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Notes
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantity
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Unit Price incl. VAT
                            </th>
                            <th scope="col" class="px-6 py-3">
                               Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->cart->items as $item)
                        <tr class="border-b-2">
                            <th class="px-6 py-4 font-normal">
                                {{ $item->product->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $item->notes }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($item->product->price) }} {{ $item->product->currency }}
                            </td>

                            <td class="px-6 py-4">
                                {{ number_format($item->product->price * $item->quantity) }} {{ $item->product->currency }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- payment summary --}}
            <div class="flex flex-row justify-end mt-10 lg:mt-0 px-6">
                <ul class="w-full lg:px-0 lg:w-3/5">
                    <li class="flex flex-row items-center justify-between px-6 py-4 border-b-2">
                        <h2 class="text-sm font-bold text-gray-600">SUBTOTAL</h2>
    
                        <span class="text-xl">
                            {{ number_format($order->cart->total_amount) }} {{ $order->cart->currency }}
                        </span>
                    </li>
    
                    <li class="flex flex-row items-center justify-between px-6 py-4 border-b-2">
                        <h2 class="text-sm font-bold text-gray-600">SHIPPING FEE</h2>
    
                        <span class="text-xl">
                            free
                        </span>
                    </li>
    
                    <li class="flex flex-row items-center justify-between px-6 py-4">
                        <h2 class="text-sm font-bold text-gray-600">TOTAL</h2>
    
                        <span class="text-2xl font-bold">
                            {{ number_format($order->cart->total_amount) }} {{ $order->cart->currency }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- add more space for avoid cart bar override content --}}
    <div class="w-full min-h-[50px]"></div>
@endsection
