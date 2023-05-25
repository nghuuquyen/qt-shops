<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page_title ?? 'Coffee Shops' }}</title>

    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body class="bg-[#F3F3F2] min-h-[2000px]">
    <x-logo />

    @yield('navigation')

    <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 mt-6">
        @yield('main')
    </main>
    
    @yield('components')

    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>