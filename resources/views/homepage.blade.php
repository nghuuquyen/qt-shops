@extends('layouts.base')

@section('navigation')
    <x-navigation :categories="$categories" />
@endsection

@section('main')
    @foreach ( $categories as $category )
        <x-product-grids
            :category="$category"
            :products="$category['products']" />
    @endforeach
@endsection

@section('components')
    <livewire:cart-bar />
    
    <livewire:add-cart-item-popup />
@endsection