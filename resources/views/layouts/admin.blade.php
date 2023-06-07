@php
    use \Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\App;

    $theme = Session::get('theme', 'auto');

    $locale = App::currentLocale();

    $bg_backgroud = 'bg-background';

    if ($theme == 'theme-light') {
        $bg_backgroud = 'bg-gradient-to-r from-rose-100 to-teal-100';
    }
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}" class="{{ $theme }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $page_title ?? 'Coffee Shops' }}</title>

        @livewireStyles
        @vite('resources/css/app.css')
    </head>

    <body class="{{ $bg_backgroud }}">

        <x-admin-navigation :hasSetting="true" />

        {{-- screen title --}}
        <div class="flex flex-row bg-surface border-t border-on-surface-500">
            <div class="max-w-screen-xl m-auto flex flex-row  justify-between items-center lg:p-10 p-4 w-full ">
                <h1 class="text-on-surface-600 font-bold text-3xl">@yield('page_title')</h1>
                @yield('page_action')
            </div>
        </div>

        {{-- main content --}}
        <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 lg:p-10 p-4">
            @yield('main')
        </main>
        
        @yield('components')

        {{-- flash message --}}
        <div class="absolute top-10 z-10 right-5 w-64">
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transtion
                    class="bg-primary-500 text-on-primary-50 p-4 mb-2 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <script>
            window.theme = '{{ $theme }}';
        </script>

        @livewireScripts
        @vite('resources/js/app.js')
    </body>
</html>