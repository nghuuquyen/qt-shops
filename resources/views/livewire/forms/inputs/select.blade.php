<div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
    <div class="col-span-1 text-on-surface-500 font-bold">
        @if ($field->hasLabel())
            <label>{{ __($field->getLabel()) }}</label>
        @endif
    </div>
    <div class="col-span-4 text-on-surface-600">
        <div class="flex flex-row">
            @if ($form->isViewMode())
                <span>{{ $field->getValue() }}</span>
            @else
                <select
                    class="w-full border text-on-surface-600 border-on-surface-300 px-2 py-4 bg-surface @error($field->getName() ?? '') border-red-500 @enderror"
                    type="{{ $field->getType() }}" placeholder="{{ $field->getPlaceholder() }}"
                    @if ($field->hasModel()) wire:model="{{ $field->getModel() }}" @endif
                    @if ($field->hasName()) name="{{ $field->getName() }}" @endif
                    @if ($field->isReadonly()) readonly="true" @endif
                    @if ($field->hasValue() || $form->isCreateMode()) value="{{ old($field->getName(), $field->getValue()) }}" @endif>

                    <option value="" disabled>{{ __('Please choose') }}</option>

                    @php
                        $selected = old($field->getName(), $field->getValue());
                    @endphp

                    @foreach ($options as $option)
                        <option value="{{ $option['value'] }}" @if ($selected == $option['value']) selected @endif>
                            {{ $option['text'] }}
                        </option>
                    @endforeach
                </select>
                @error($field->getName() ?? '')
                    <span class="text-sm block sm:inline text-red-500">{{ $message }}</span>
                @enderror
            @endif

            @if ($field->hasSuffix())
                <span class="ml-4 text-on-surface-500">{{ $field->getSuffix() }}</span>
            @endif
        </div>
    </div>
</div>
