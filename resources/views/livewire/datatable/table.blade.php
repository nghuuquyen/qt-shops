<div class="relative overflow-x-auto">
    <table class="w-full text-left table-auto text-on-surface-600">
        <thead class="font-bold text-on-surface-600">
            <tr class="border-b border-on-surface-600">
                @foreach($columns as $column)
                <th scope="col" class="text-base font-bold px-2 py-4 uppercase">
                    {{ __($column->title) }}
                </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr class="border-b border-on-surface-400">
                    @foreach($columns as $column)
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
