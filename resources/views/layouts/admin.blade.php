@extends('layouts.base')

@section('content')
    <x-admin-navigation :hasSetting="true" />

    {{-- screen title --}}
    <div class="flex flex-row bg-surface border-t border-on-surface-500">
        <div class="max-w-screen-xl m-auto flex flex-row  justify-between items-center lg:p-10 p-4 w-full ">
            <h1 class="text-on-surface-600 font-bold text-3xl ml-2">@yield('page_title')</h1>
            @yield('page_action')
        </div>
    </div>

    {{-- main content --}}
    <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 lg:p-10 p-4">
        @yield('main')
    </main>

    {{-- flash message --}}
    <div class="absolute z-10 left-5 bottom-5 w-auto">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transtion
                class="bg-primary-500 text-on-primary-50 p-4 mb-2 rounded-lg">
                {{ session('message') }}
            </div>
        @endif
    </div>
@endsection
