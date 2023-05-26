@if (isset($href))
<a href="{{ $href }}" target="{{ $target ?? '_blank' }}" {{ $attributes->merge(['class' => 'flex bg-green-600 hover:bg-green-700 active:translate-y-1 rounded-lg lg:rounded-2xl text-white px-6 py-2 flex-shrink-0 w-auto items-center justify-center']) }}>
    @includeIf('components/icons/' . ( $icon ?? '' ))

    <span class="ml-2">
        {{ $slot }}
    </span>
</a>
@else
<button type="{{  $type ?? 'button' }}" {{ $attributes->merge(['class' => 'flex bg-green-600 hover:bg-green-700 active:translate-y-1 rounded-lg lg:rounded-2xl text-white px-6 py-2 flex-shrink-0 w-auto items-center justify-center']) }}>
    @includeIf('components/icons/' . ( $icon ?? '' ))

    <span class="ml-2">
        {{ $slot }}
    </span>
</button>
@endif