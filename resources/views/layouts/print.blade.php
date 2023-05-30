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
        <x-logo :hasSetting="false" class="bg-transparent pt-6"/>

        <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 p-4 lg:p-10">
            @yield('main')
        </main>
        
        @yield('components')

        <script>
            window.theme = '{{ $theme }}';
        </script>

        @livewireScripts
        @vite('resources/js/app.js')
    </body>
</html>