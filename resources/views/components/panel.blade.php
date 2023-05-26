<div {{  $attributes->merge(['class' => 'bg-white rounded-lg']) }}>
    @if (isset( $header))
        <h1 class="bg-white text-2xl text-gray-600 border-b p-4 mb-2 flex flex-row items-center sticky top-0">
            @includeIf('components/icons/' . ( $icon ?? '' ))

            <span class="ml-2">{{ $header }}</span>
        </h1>        
    @endif

    <div class="p-6">
       {{ $slot }}
    </div>
</div>