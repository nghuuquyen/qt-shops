@extends('layouts.base')

@section('main')
    <section class="p-4 mt-6 px-2 py-2 lg:px-24">
        <div class="flex flex-col items-center justify-center">
            <img class="w-64" src="/icons/celebrate.png" />

            <h1 class="text-3xl font-bold mt-3">THANK YOU!</h1>

            <h2>Your order number is <span class="font-bold">{{ $order->code }}</span></h2>
            <p class="text-gray-500 mt-6 max-w-screen-sm text-center">
                We are getting started on your order right away, and you will receive an order
                comfirmtion email shortly to <span class="font-bold">{{ $order->email }}</span>
            </p>

            <x-button class="mt-5" href="{{ $order->getPath() }}">
                VIEW ORDER CONFIRMTION
            </x-button>
        </div>
    </section>
@endsection