<div class="flex flex-col">
    <label class="font-normal mb-2">{{ $label ?? '' }}</label>

    <input class="border px-2 py-4" type="{{ $type ?? 'text' }}" placeholder="{{ $placeholder ?? '' }}"
        @if (isset($model)) wire:model="{{ $model }}" @endif
        @if (isset($name)) name="{{ $name }}" @endif
        @if (isset($value)) value="{{ $value }}" @endif />
    
    @if (isset($name))
        @error($name)
            <span class="text-sm block sm:inline text-red-500">{{ $message }}</span>
        @enderror
    @endif
</div>
