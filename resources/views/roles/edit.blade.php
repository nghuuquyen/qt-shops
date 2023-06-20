@extends('layouts.admin')

@section('page_title')
    {{ Str::headline($role->name) }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end -mx-5">
        <x-button icon="arrow-uturn-left" href="{{ route('roles.show', ['role' => $role->id]) }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to view') }}
        </x-button>
    </div>
@endsection

@section('main')
    <section>
        <x-panel>
            <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex flex-col">
                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Title') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input name="name" value="{{ old('name', $role->name) }}"
                                placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 border-b border-on-surface-900 items-base">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Permissions') }}</label>
                        </div>

                        <div class="col-span-4 text-on-surface-600">
                            @foreach ($permissions->pluck('group')->unique() as $group)
                                <div class="grid grid-cols-1 gap-4 md:mb-10">
                                    <div class="mb-4 pb-2 border-b border-on-surface-500">
                                        <span class="text-on-surface-500 text-sm uppercase">{{ Str::title($group) }}</span>
                                    </div>

                                    <div class="text-on-surface-600 grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                                        @foreach ($permissions->filter(fn($item) => $item->group == $group) as $permission)
                                            <x-checkbox name="permissions[]" label="{{ Str::headline($permission->name) }}"
                                                selected="{{ $permission->checked }}" value="{{ $permission->name }}">
                                            </x-checkbox>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
        </x-panel>
    </section>
@endsection
