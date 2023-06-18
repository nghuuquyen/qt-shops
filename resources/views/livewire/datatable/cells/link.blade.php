<td class="text-base px-2 py-4 text-primary-500">
    <div class="flex flex-row">
        @foreach ($href as $index => $link)
            <a @isset($link['value']) href="{{ $link['value'] }}" @endisset target="{{ $link['target'] ?? '_self' }}">
                {{ __($link['title']) }}
            </a>
            @if (!$loop->last)
                <span class="px-2 text-on-surface-500">/</span>
            @endif
        @endforeach
    </div>
</td>
