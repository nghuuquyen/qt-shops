@extends('layouts.admin')

@section('page_title')
    {{ $product->name }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button icon="arrow-uturn-left" href="{{ route('products.index') }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to list') }}
        </x-button>

        @can('update', $product)
            <x-button href="{{ route('products.edit', ['product' => $product->id]) }}" target="_self" icon="edit"
                class="text-base font-normal">
                {{ __('Edit') }}
            </x-button>
        @endcan
    </div>
@endsection

@section('main')
    <section class="relative">
        <x-panel>
            <div class="flex flex-col">
                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Image') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <img class="object-cover h-28 w-28 rounded" src="{{ $product->display_image_url }}?w=150&h=150"
                            alt="product image" />
                    </div>
                </div>

                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Name') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ $product->name }}</span>
                    </div>
                </div>

                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Unit price incl. VAT') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ $product->formatted_price }}</span>
                    </div>
                </div>

                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Description') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ $product->description }}</span>
                    </div>
                </div>
            </div>

            @can('delete', $product)
                <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}" class="mt-5 -mr-5">
                    @csrf
                    @method('DELETE')

                    <div class="flex flex-row justify-end">
                        <x-button icon="trash" type="submit"
                            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                            {{ __('Remove this item') }}
                        </x-button>
                    </div>
                </form>
            @endcan
        </x-panel>
    </section>
@endsection
