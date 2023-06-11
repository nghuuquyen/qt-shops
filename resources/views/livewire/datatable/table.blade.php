<div>
    {{-- toolbar --}}
    <div class="flex flex-row justify-between items-center mb-6 mt-4">
        {{-- left-side --}}
        <div class="flex flex-row justify-start items-center">
            <x-text-input class="w-80" wire:model="search" name="search" placeholder="{{ __('Search') }}" />

            <div class="ml-5">
                <x-dropdown title="{{ __('Filters') }}" icon="funnel">
                    <div class="w-full min-w-[250px]">
                        @foreach ($filters as $filter)
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

                    @foreach ($display_columns as $index => $column)
                        <li
                            class="px-4 py-2 flex flex-row items-center justify-start cursor-pointer hover:bg-surface-800 rounded-lg">
                            <input id="{{ $column['id'] }}" wire:model="display_columns.{{ $index }}.display"
                                type="checkbox" />

                            <label for="{{ $column['id'] }}"
                                class="ml-2 w-full flex-shrink-0">{{ $column['title'] }}</label>
                        </li>
                    @endforeach
                </ul>
            </x-dropdown>

            <x-dropdown title="{{ $page_size }}" icon="chevron-down">
                <ul class="w-full text-on-surface-600 text-center">
                    @foreach ($page_size_options as $option)
                        <li wire:click="setPageSize({{ $option }})" @click="toggle()"
                            class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg {{ $option == $page_size ? 'bg-primary-600 text-on-primary-50' : '' }}">
                            {{ $option }}</li>
                    @endforeach
                </ul>
            </x-dropdown>
        </div>
    </div>

    {{-- table --}}
    <div class="relative overflow-x-auto">
        <table class="w-full text-left table-auto text-on-surface-600">
            <thead class="font-bold text-on-surface-600">
                <tr class="border-b border-on-surface-600">
                    @foreach ($columns as $column)
                        @if ($column->display)
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
                        @foreach ($columns as $col => $column)
                            @if ($column->display)
                                <livewire:datatable.cell :column="$column" :item="$item"
                                    wire:key="{{ $row . $col }}_{{ $item->id }}" />
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
