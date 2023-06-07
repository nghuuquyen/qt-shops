@extends('layouts.admin')

@section('main')
    <section>
        <x-panel icon="cube" header="{{ $product->name }}">
            <form action="{{ route('products.update', [ 'product' => $product->id ]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex flex-row justify-end">
                    <x-button icon="arrow-uturn-left" href="{{ route('products.show', ['product' => $product->id]) }}"
                        target="_self"
                        class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-50 hover:bg-transparent">
                        {{ __('Back to view') }}
                    </x-button>

                    <x-button type="submit" icon="document" class="text-base font-normal">
                        {{ __('Save') }}
                    </x-button>
                </div>

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
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Name') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input name="name" value="{{ old('name',  $product->name) }}"
                                placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Unit price incl. VAT') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600 flex flex-row items-center">
                            <x-text-input name="price" value="{{ old('price', $product->price)  }}"
                                placeholder="{{ __('Please input this field') }}" />
                            <span class="ml-4 text-on-surface-500">{{ $product->currency }}</span>
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Description') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input name="description" value="{{ old('description', $product->description) }}"
                                placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>
                </div>
            </form>
        </x-panel>
    </section>
@endsection
