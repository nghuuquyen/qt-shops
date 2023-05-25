<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coffee Shops</title>

    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body class="bg-[#F3F3F2] min-h-[2000px]">
    <x-logo />

    <x-navigation :categories="$categories" />

    <main class="max-w-screen-xl m-auto grid grid-cols-1 gap-10 mt-6">
        @foreach ( $categories as $category )
            <x-product-grids
                :category="$category"
                :products="$category['products']" />
        @endforeach
    </main>

    <livewire:cart-bar />

    <livewire:add-cart-item-popup />
    
    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>