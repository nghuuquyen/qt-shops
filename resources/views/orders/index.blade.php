@extends('layouts.admin')

@section('page_title')
{{ __('Orders') }}
@endsection

@section('main')
<section>
    <x-panel icon="cube">
        <livewire:order-table />
    </x-panel>
</section>
@endsection