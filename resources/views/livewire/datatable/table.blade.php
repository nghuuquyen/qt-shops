<div>
    {{-- header bar --}}
    <div class="flex flex-row justify-between items-center mb-6 mt-4">
        {{-- left-side --}}
        <div class="flex flex-row justify-start items-center">
            <x-text-input class="w-80" name="search" placeholder="{{ __('Search') }}" />
            <div class="ml-5">
                <x-dropdown title="{{ __('Filters') }}" icon="funnel">
                    <div class="min-w-[200px]">
                        {{-- filter item --}}
                        <div>
                            <div class="text-on-surface-500 mb-2">
                                {{ __('Category') }}
                            </div>

                            <x-select>
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </x-select>
                        </div>

                        {{-- filter item --}}
                        <div>
                            <div class="text-on-surface-500 mb-2 mt-2">
                                {{ __('Category') }}
                            </div>

                            <x-select>
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </x-select>
                        </div>
                    </div>
                </x-dropdown>
            </div>
        </div>

        {{-- right-side --}}
        <div class="flex flex-row gap-4">
            <x-dropdown title="{{ __('Columns') }}" icon="chevron-down">
                <ul class="w-full min-w-full text-on-surface-600">
                    <li class="py-2 flex flex-row items-center justify-start cursor-pointer hover:bg-surface-800 rounded-lg">
                        <input type="checkbox" />
                        <span class="ml-2 flex-shrink-0">Column A</span>
                    </li>
                    <li class="py-2 flex flex-row items-center justify-start cursor-pointer hover:bg-surface-800 rounded-lg">
                        <input type="checkbox" />
                        <span class="ml-2 flex-shrink-0">Column B</span>
                    </li>
                    <li class="py-2 flex flex-row items-center justify-start cursor-pointer hover:bg-surface-800 rounded-lg">
                        <input type="checkbox" />
                        <span class="ml-2 flex-shrink-0">Column C</span>
                    </li>
                    <li class="py-2 flex flex-row items-center justify-start cursor-pointer hover:bg-surface-800 rounded-lg">
                        <input type="checkbox" />
                        <span class="ml-2 flex-shrink-0">Column D</span>
                    </li>
                    <li class="py-2 flex flex-row items-center justify-start cursor-pointer hover:bg-surface-800 rounded-lg">
                        <input type="checkbox" />
                        <span class="ml-2 flex-shrink-0">Column E</span>
                    </li>
                </ul>
            </x-dropdown>

            <x-dropdown title="{{ __('Rows') }}" icon="chevron-down">
                <ul class="w-full text-on-surface-600 text-center">
                    <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">5</li>
                    <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">10</li>
                    <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">20</li>
                    <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">30</li>
                    <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">40</li>
                    <li class="px-6 py-2 cursor-pointer hover:bg-surface-800 rounded-lg">50</li>
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
                        <th scope="col" class="text-base font-bold px-2 py-4 uppercase">
                            {{ __($column->title) }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr class="border-b border-on-surface-400">
                        @foreach ($columns as $column)
                            <livewire:datatable.cell :column="$column" :item="$item" />
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
