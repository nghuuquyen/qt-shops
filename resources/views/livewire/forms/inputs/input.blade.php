<div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
    <div class="col-span-1 text-on-surface-500 font-bold">
        @if ($field->hasLabel())
            <label>{{ __($field->getLabel()) }}</label>
        @endif
    </div>
    <div class="col-span-4 text-on-surface-600">
        <div class="flex flex-row w-full items-center">
            @if ($form->isViewMode())
                @if ($field->isExplodeAsTags())
                    @foreach (explode(',', $field->getValue()) as $text)
                        <span class="bg-surface-800 px-4 py-2 rounded-lg mr-2">{{ $text }}</span>
                    @endforeach
                @else
                    <span>{{ $field->getValue() }}</span>
                @endif
            @else
                <div class="flex flex-col w-full">
                    <input
                        class="{{ 'w-full border text-on-surface-600 border-on-surface-300 px-4 py-4 bg-surface ' . ($errors->has($field->getName()) ? ' border-red-500' : '') }}"
                        type="{{ $field->getType() }}" placeholder="{{ $field->getPlaceholder() }}"
                        @if ($field->hasModel()) wire:model="{{ $field->getModel() }}" @endif
                        @if ($field->hasName()) name="{{ $field->getName() }}" @endif
                        @if ($field->isReadonly()) readonly="true" @endif
                        @if ($field->hasValue() || $form->isCreateMode()) value="{{ old($field->getName(), $field->getValue()) }}" @endif />

                    @error($field->getName() ?? '')
                        <span class="text-sm block sm:inline text-red-500 mt-2">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            @if ($field->hasSuffix())
                <span class="ml-4 text-on-surface-500">{{ $field->getSuffix() }}</span>
            @endif
        </div>
    </div>
</div>
