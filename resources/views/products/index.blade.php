@extends('layouts.admin')

@section('page_title')
Products
@endsection

@section('page_action')
<div class="flex flex-row justify-end">
    <x-button href="{{ route('products.create') }}" target="_self" icon="plus" class="text-base font-normal">
        {{ __('Create') }}
    </x-button>
</div>
@endsection

@section('main')
<section>
    <x-panel icon="cube">
        {{-- products table --}}
        <div class="relative overflow-x-auto">
            <table class="w-full text-left table-auto text-on-surface-600">
                <thead class="font-bold text-on-surface-600">
                    <tr class="border-b border-on-surface-600">
                        <th scope="col" class="text-base font-bold px-2 py-4 uppercase">
                            {{ __('Image') }}
                        </th>
                        <th scope="col" class="text-base font-bold px-2 py-4 uppercase">
                            {{ __('Name') }}
                        </th>
                        <th scope="col" class="text-base font-bold px-2 py-4 uppercase">
                            {{ __('Unit price incl. VAT') }}
                        </th>
                        <th scope="col" class="text-base font-bold px-2 py-4 uppercase">
                        
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b border-on-surface-400">
                            <th class="text-base px-2 py-4 font-normal">
                                <img class="w-10 h-10 object-cover rounded" src="{{ $product->display_image_url }}?w=150&h=150" />
                            </th>
                            <th class="text-base px-2 py-4 font-normal">
                                {{ $product->name }}
                            </th>
                            <td class="text-base px-2 py-4">
                                {{ $product->formatted_price }}
                            </td>
                            <td class="text-base px-2 py-4 text-primary-500">
                               <a href="{{ route('products.show', [ 'product' => $product->id ]) }}">{{ __('View') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-5">
                {{ $products->links() }}
            </div>
        </div>
    </x-panel>
</section>
@endsection