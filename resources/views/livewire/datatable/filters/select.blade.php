{{-- filter item --}}
<div>
    <div class="text-on-surface-500 mb-2">
        {{ __('Category') }}
    </div>

    <x-select model="value">
        @foreach ( $options as $value => $title)
            <option value="{{ $value }}">{{ $title }}</option>
        @endforeach
    </x-select>
</div>