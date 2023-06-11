<div>
    <div class="text-on-surface-500 mb-2">
        {{ __($name) }}
    </div>

    <x-select model="{{ $table->table_name }}.filters.{{ $filter->getKey() }}">
        
        <option value="" selected>{{ $placeholder ?? __('All') }}</option>

        @foreach ( $options as $value => $title)
            <option value="{{ $value }}">{{ $title }}</option>
        @endforeach
    </x-select>
</div>