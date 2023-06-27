<div x-cloak class="z-20 right-5 top-5 fixed w-max" x-data="{ show: @entangle('show') }" x-show="show">
    @foreach ($messages as $index => $item)
        <div x-transtion
            class="bg-surface-900 text-on-surface-100 p-4 mb-2 rounded-lg flex flex-row items-start px-8 max-w-[450px]">
            <span class="mr-4 w-8 mt-1 text-on-surface-300">
                @include('components.icons.bell-alert')
            </span>

            <div class="flex flex-col">
                <span class="text-base font-bold mb-1">{{ $item['title'] }}</span>
                <span>{{ $item['message'] }}</span>
                <div class="flex flex-row mt-4">
                    <a href="{{ $item['action_url'] }}" target="_blank" class="text-primary-600 mr-3 cursor-pointer">{{ $item['action_title'] }}</a>
                    <a class="text-on-surface-300 cursor-pointer" wire:click="dismissNotify({{ $index }})">{{ __('Dismiss') }}</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
