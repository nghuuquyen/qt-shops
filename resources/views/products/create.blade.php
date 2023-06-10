@extends('layouts.admin')

@section('page_title')
{{ __('Create New') }}
@endsection

@section('page_action')
<div class="flex flex-row justify-end">
    <x-button icon="arrow-uturn-left" href="{{ route('products.index') }}" target="_self"
        class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
        {{ __('Back to list') }}
    </x-button>
</div>
@endsection

@section('main')
    <section>
        <x-panel>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="flex flex-col">
                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Name') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input name="name" value="{{ old('name') }}"
                                placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Unit price incl. VAT') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600 flex flex-row items-center">
                            <x-text-input name="price" value="{{ old('price') }}"
                                placeholder="{{ __('Please input this field') }}" />
                            <span class="ml-4 text-on-surface-500">{{ $currency }}</span>
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Description') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input name="description" value="{{ old('description') }}"
                                placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>
                </div>

                <div class="flex flex-row justify-end mt-10">
                    <x-button type="reset"
                        class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                        {{ __('Reset') }}
                    </x-button>

                    <x-button type="submit" icon="document" class="text-base font-normal">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-panel>
    </section>
@endsection