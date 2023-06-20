<div class="grid grid-cols-5 pb-6 pt-6 items-start border-b border-on-surface-900">
    <div class="col-span-1 text-on-surface-500 font-bold">
        @if ($field->hasLabel())
            <label>{{ __($field->getLabel()) }}</label>
        @endif
    </div>

    <div class="col-span-4 text-on-surface-600">
        <div class="flex flex-col w-full">
            @if ($form->isViewMode())
                <div class="text-on-surface-600 grid grid-cols-2 md:grid-cols-3 gap-4 mb-4 w-full">
                    @foreach ($options as $value => $text)
                        <div class="flex flex-row items-center">
                            @if ($values->search($value) !== false)
                                <x-icon class="mr-2 text-primary-600" icon="check-circle" />
                                <span>{{ __($field->getFormattedOptionLabel($text)) }}</span>
                            @else
                                <x-icon class="mr-2 text-on-surface-900" icon="check-circle" />
                                <span
                                    class="text-on-surface-900">{{ __($field->getFormattedOptionLabel($text)) }}</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-on-surface-600 grid grid-cols-2 md:grid-cols-3 gap-4 mb-4 w-full">
                    @foreach ($options as $value => $text)
                        <div class="flex flex-row items-center">
                            <input id="checkbox_list_value_{{ md5($value) }}"
                                class="{{ 'border text-on-surface-600 border-on-surface-300 px-4 py-4 bg-surface cursor-pointer ' . ($errors->has($name ?? null) ? ' border-red-500' : '') }}"
                                @if ($field->hasModel()) wire:model="{{ $field->getModel() }}" @endif
                                @if ($field->hasName()) name="{{ $field->getName() }}[]" @endif
                                @if ($field->isReadonly()) readonly="true" @endif
                                @if ($values->search($value) !== false) checked @endif
                                value="{{ old($field->getName(), $value) }}" type="checkbox" />

                            <label for="checkbox_list_value_{{ md5($value) }}"
                                class="font-normal ml-2 text-on-surface-600 cursor-pointer">
                                {{ __($field->getFormattedOptionLabel($text)) }}
                            </label>
                        </div>
                    @endforeach
                </div>

                @error($field->getName() ?? '')
                    <div>
                        <span class="text-sm block sm:inline text-red-500">{{ $message }}</span>
                    </div>
                @enderror
            @endif
        </div>
    </div>
</div>
