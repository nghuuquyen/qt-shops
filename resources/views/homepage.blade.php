@extends('layouts.user')

@section('navigation')
    <x-navigation :categories="$categories" />
@endsection

@section('main')
    @foreach ($categories as $category)
        <x-product-grids :category="$category" :products="$category['products']" />
    @endforeach

    {{-- add more space for avoid cart bar override content --}}
    <div class="w-full min-h-[150px]"></div>
@endsection

@section('components')
    <livewire:cart-bar />

    <livewire:add-cart-item-popup />
@endsection
