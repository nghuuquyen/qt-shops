@extends('layouts.base')

@section('content')
    <x-logo :hasSetting="true" />

    @yield('navigation')

    <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 mt-6 lg:p-10 p-4">
        @yield('main')
    </main>
@endsection
