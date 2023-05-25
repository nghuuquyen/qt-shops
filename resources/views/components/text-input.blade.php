<div class="flex flex-col">
    <label class="font-normal mb-2">{{ $label ?? '' }}</label>
    <input class="border px-2 py-4" type="text" placeholder="{{ $placeholder }}" wire:model="{{ $model }}" />
</div>