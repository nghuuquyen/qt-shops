@php
    use Illuminate\Support\Facades\Session;
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

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>{{ $page_title ?? 'Coffee Shops' }}</title>

    @livewireStyles
    @vite('resources/css/app.css')
    @stack('styles')
    <script>
        window.theme = '{{ $theme }}';
    </script>
    @livewireScripts
    @vite('resources/js/app.js')
    @stack('scripts')
</head>

<body class="{{ $bg_backgroud }}">

    @yield('content')

    @yield('components')
</body>

</html>
