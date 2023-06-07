@extends('layouts.base')

@section('content')
    <x-logo :hasSetting="false" class="bg-transparent pt-6" />

    <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 p-4 lg:p-10">
        @yield('main')
    </main>
@endsection
