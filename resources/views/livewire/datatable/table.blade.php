<div>
    {{-- filter pills --}}
    @if ($table->hasFilterPills())
        <div class="flex flex-row items-center">
            <div class="mr-2">
                <span class="text-on-surface-500">{{ __('Applied Filters') }}</span>
            </div>

            <ul class="flex flex-row">
                @foreach ($table->getAppliedFiltersWithValues() as $key => $value)
                    @php
                        $filter = $table->getFilterByKey($key);
                    @endphp

                    @if ($filter->validate($value))
                        <li
                            class="bg-surface-800 text-on-surface-100 px-4 py-2 mr-2 rounded-lg flex flex-row items-center">
                            <span>{{ $filter->getFilterPillTitle() }}: {{ $filter->getFilterPillValue($value) }}</span>

                            <x-button icon="x-mark" wire:click="removeFilter('{{ $filter->getKey() }}')"
                                class="bg-transparent hover:bg-transparent hover:text-on-surface-100"
                                style="padding: 0; margin-left: 5px;" />
                        </li>
                    @endif
                @endforeach

                <x-button wire:click="removeAllFilter()"
                    class="bg-transparent hover:bg-transparent hover:text-on-surface-100"
                    style="padding: 0; margin-left: 5px;">
                    {{ __('Clear all') }}
                </x-button>
            </ul>
        </div>
    @endif

    {{-- toolbar --}}
    <div class="flex flex-row justify-between items-center mb-6 mt-4">
        {{-- left-side --}}
        <div class="flex flex-row justify-start items-center">
            <x-text-input class="w-80" wire:model="search" name="search" placeholder="{{ __('Search') }}" />

            <div class="ml-5">
                <x-dropdown title="{{ __('Filters') }}" icon="funnel">
                    <div class="w-full min-w-[250px] grid grid-cols-1 gap-4">
                        @foreach ($table->getFilters() as $filter)
                            {{ $filter->render($table) }}
                        @endforeach
                    </div>
                </x-dropdown>
            </div>
        </div>

        {{-- right-side --}}
        <div class="flex flex-row gap-4">
            <x-dropdown title="{{ __('Actions') }}" icon="chevron-down">
                <ul class="w-full min-w-full text-on-surface-600">

                    <li
                        class="px-4 py-2 flex flex-row items-center justify-start cursor-pointer hover:bg-surface-800 rounded-lg">
                        <span>{{ __('Export as CSV') }}</span>
                    </li>
                </ul>
            </x-dropdown>

            <x-dropdown title="{{ __('Columns') }}" icon="chevron-down">
                <ul class="w-full min-w-full text-on-surface-600">

                    @foreach ($table->getDisplayColumns() as $index => $column)
                        <li
                            class="px-4 py-2 flex flex-row items-center justify-start cursor-pointer hover:bg-surface-800 rounded-lg">
                            <input id="{{ $column['uuid'] }}" wire:model="columns.{{ $index }}.display"
                                type="checkbox" />

                            <label for="{{ $column['uuid'] }}"
                                class="ml-2 w-full h-full flex-shrink-0">{{ $column['title'] }}</label>
                        </li>
                    @endforeach
                </ul>
            </x-dropdown>

            <x-dropdown title="{{ $per_page }}" icon="chevron-down">
                <ul class="w-full text-on-surface-600 text-center">
                    @foreach ($table->getPerPageOptions() as $option)
                        <li wire:click="setPerPage({{ $option }})" @click="toggle()"
                            class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg {{ $option == $per_page ? 'bg-primary-600 text-on-primary-50' : '' }}">
                            {{ $option }}</li>
                    @endforeach
                </ul>
            </x-dropdown>
        </div>
    </div>

    {{-- table --}}
    <div class="relative overflow-x-auto">
        <table class="w-full text-left table-auto text-on-surface-600">
            <thead class="font-bold text-on-surface-600 bg-surface-900">
                <tr class="border-b border-on-surface-600">
                    @foreach ($table->getColumns() as $column)
                        @if ($table->isDisplayColumn($column))
                            <th scope="col" class="text-base font-bold px-2 py-4 uppercase">
                                {{ __($column->title) }}
                            </th>
                        @endif
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $row => $item)
                    <tr class="border-b border-on-surface-400">
                        @foreach ($table->getColumns() as $col => $column)
                            @if ($table->isDisplayColumn($column))
                                {{ $column->render($item) }}
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5">
            {{ $items->links() }}
        </div>
    </div>
</div>
