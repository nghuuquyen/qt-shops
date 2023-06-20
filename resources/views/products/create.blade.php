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
            <livewire:products.product-form />
        </x-panel>
    </section>
@endsection
