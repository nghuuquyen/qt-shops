@extends('layouts.base')

@section('content')
    <x-logo :hasSetting="true" />

    @if (isset($navigation))
        {{ $navigation }}
    @endif

    @if (isset($main))
        <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 mt-6 lg:p-10 p-4">
            {{ $main }}
        </main>
    @endif
@endsection

@if (isset($components))
    @section('components')
        {{ $components }}
    @endsection
@endif
