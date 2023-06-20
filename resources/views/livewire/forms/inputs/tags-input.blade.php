<div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
    <div class="col-span-1 text-on-surface-500 font-bold">
        @if ($field->hasLabel())
            <label>{{ __($field->getLabel()) }}</label>
        @endif
    </div>

    <div class="col-span-4 text-on-surface-600">
        <div class="flex flex-col w-full">
            @if ($form->isViewMode())
                <div class="text-on-surface-600 flex flex-wrap">
                    @foreach ($values as $value)
                        <span class="bg-surface-800 px-4 py-2 rounded-lg mr-2 mt-2">
                            {{ __($field->getFormattedOptionLabel($value)) }}
                        </span>
                    @endforeach
                </div>
            @else
                <div class="text-on-surface-600 grid grid-cols-2 md:grid-cols-3 gap-4 mb-4 w-full">
                    <span>Sorry, Not yet implement this field</span>
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
