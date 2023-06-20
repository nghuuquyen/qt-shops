@extends('layouts.admin')

@section('page_title')
{{ __('Customers') }}
@endsection

@section('main')
<section>
    <x-panel icon="cube">
        <livewire:orders.customer-table />
    </x-panel>
</section>
@endsection