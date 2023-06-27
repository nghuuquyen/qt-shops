@extends('layouts.base')

@section('content')
    <x-admin-navigation :hasSetting="true" />

    <livewire:users.user-notification />

    {{-- screen title --}}
    <div class="flex flex-row bg-surface border-t border-on-surface-500">
        <div class="max-w-screen-xl m-auto flex flex-col md:flex-row justify-between items-center lg:p-10 p-4 w-full ">
            @if (isset($page_title))
                <h1 class="text-on-surface-600 font-bold text-3xl ml-2 w-full text-center md:text-left">
                    {{ $page_title }}
                </h1>
            @endif

            @if (isset($page_action))
                <div class="flex flex-row w-full justify-end mt-2 md:mt-0">
                    {{ $page_action }}
                </div>
            @endif
        </div>
    </div>

    {{-- main content --}}
    @if (isset($main))
        <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 p-2 lg:p-10">
            {{ $main }}
        </main>
    @endif

    {{-- flash message --}}
    <div class="z-20 left-5 bottom-5 fixed w-max">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transtion
                class="bg-primary-500 text-on-primary-50 p-4 mb-2 rounded-lg">
                {{ session('message') }}
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endpush
