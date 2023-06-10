<div class="flex flex-col">
    @isset($label)
        <label class="font-normal mb-2 text-on-surface-600">{{ $label ?? '' }}</label>
    @endisset

    <input
        {{ $attributes->merge([
            'class' =>
                'border text-on-surface-600 border-on-surface-300 px-2 py-4 bg-surface ' .
                ($errors->has($name) ? ' border-red-500' : ''),
        ]) }}
        type="{{ $type ?? 'text' }}" placeholder="{{ $placeholder ?? '' }}"
        @if (isset($model)) wire:model="{{ $model }}" @endif
        @if (isset($name)) name="{{ $name }}" @endif
        @if (isset($value)) value="{{ $value }}" @endif />

    @error($name ?? '')
        <span class="text-sm block sm:inline text-red-500">{{ $message }}</span>
    @enderror
</div>
