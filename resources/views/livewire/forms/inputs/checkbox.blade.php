<div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
    <div class="col-span-4 text-on-surface-600">
        <div class="flex flex-row w-full">
            @if ($form->isViewMode())
                <x-icon class="mr-2 text-primary-600" icon="check-circle" />
                <span>{{ $field->getValue() }}</span>

                @if ($field->hasLabel())
                    <label class="font-normal ml-2 text-on-surface-600">{{ __($field->getLabel()) }}</label>
                @endif
            @else
                <input
                    class="{{ 'w-full border text-on-surface-600 border-on-surface-300 px-4 py-4 bg-surface ' . ($errors->has($name ?? null) ? ' border-red-500' : '') }}"
                    @if ($field->hasModel()) wire:model="{{ $field->getModel() }}" @endif
                    @if ($field->hasName()) name="{{ $field->getName() }}" @endif
                    @if ($field->isReadonly()) readonly="true" @endif
                    @if ($field->hasValue()) value="{{ old($field->getName(), $field->getValue()) }}" @endif
                    type="checkbox" />

                @if ($field->hasLabel())
                    <label class="font-normal ml-2 text-on-surface-600">{{ __($field->getLabel()) }}</label>
                @endif

                @error($field->getName() ?? '')
                    <span class="text-sm block sm:inline text-red-500">{{ $message }}</span>
                @enderror
            @endif
        </div>
    </div>
</div>
