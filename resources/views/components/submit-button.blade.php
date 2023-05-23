<button {{ $attributes->merge(['class' => 'flex bg-green-600 hover:bg-green-700 active:translate-y-1 rounded-lg lg:rounded-2xl text-white px-6 py-2 flex-shrink-0 w-auto items-center justify-center']) }}>
    {{ $slot }}
</button>