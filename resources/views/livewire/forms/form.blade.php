@if ($form->isViewMode())
    {{-- view mode --}}
    <section>
        <div class="flex flex-col">
            @foreach ($fields as $field)
                @if ($field->isVisible())
                    {{ $field->render($form) }}
                @endif
            @endforeach
        </div>
    </section>
@else
    {{-- edit or create mode --}}
    <form action="{{ $form->getAction($form->getData(), $form->getMode()) }}" method="{{ $form->getFormMethod() }}">
        @csrf
        @method($form->getMethod($form->getData(), $form->getMode()))

        <div class="flex flex-col">
            @foreach ($fields as $field)
                @if ($field->isVisible())
                    {{ $field->render($form) }}
                @endif
            @endforeach
        </div>

        <div class="flex flex-row justify-end mt-10">
            <x-button type="reset"
                class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                {{ __('Reset') }}
            </x-button>
            <x-button type="submit" icon="check" class="text-base font-normal">
                {{ __('Save') }}
            </x-button>
        </div>
    </form>
@endif
