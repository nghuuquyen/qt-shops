@extends('layouts.admin')

@section('main')
<section>
    <x-panel icon="cube" header="{{ __('Products') }}">
        <div class="flex flex-row justify-end">
            <x-button href="{{ route('products.create') }}" target="_self" icon="plus" class="text-base font-normal">
                {{ __('Create') }}
            </x-button>
        </div>

        {{-- products table --}}
        <div class="relative overflow-x-auto">
            <table class="w-full text-left table-auto text-on-surface-600">
                <thead class="font-bold text-on-surface-600">
                    <tr class="border-b border-on-surface-600">
                        <th scope="col" class="text-base font-bold px-2 py-4">
                            {{ __('Image') }}
                        </th>
                        <th scope="col" class="text-base font-bold px-2 py-4">
                            {{ __('Name') }}
                        </th>
                        <th scope="col" class="text-base font-bold px-2 py-4">
                            {{ __('Unit price incl. VAT') }}
                        </th>
                        <th scope="col" class="text-base font-bold px-2 py-4">
                        
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b-2 border-on-surface-900 border-on-surface">
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