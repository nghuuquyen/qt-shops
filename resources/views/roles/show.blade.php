@extends('layouts.admin')

@section('page_title')
    {{ Str::headline($role->name) }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button icon="arrow-uturn-left" href="{{ route('roles.index') }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to list') }}
        </x-button>

        @can('update', $role)
            <x-button href="{{ route('roles.edit', ['role' => $role->id]) }}" target="_self" icon="edit"
                class="text-base font-normal ml-2">
                {{ __('Edit') }}
            </x-button>
        @endcan
    </div>
@endsection

@section('main')
    <section class="relative grid grid-cols-1 gap-6">
        <x-panel icon="cube" header="{{ __('Informations') }}">
            <div class="flex flex-col">
                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Name') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ Str::headline($role->name) }}</span>
                    </div>
                </div>

                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Permissions') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <div class="col-span-4 text-on-surface-600 grid grid-cols-3 gap-4">
                            @foreach ($role->permissions as $permission)
                                <x-checkbox name="permission" label="{{ Str::headline($permission->name) }}"
                                    selected="true"
                                    readonly="true"
                                    value="{{ $permission->name }}"> </x-checkbox>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            @can('delete', $role)
                <form method="POST" action="{{ route('roles.destroy', ['role' => $role->id]) }}" class="mt-5 -mr-5">
                    @csrf
                    @method('DELETE')

                    <div class="flex flex-row justify-end">
                        <x-button icon="trash" type="submit"
                            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                            {{ __('Remove this item') }}
                        </x-button>
                    </div>
                </form>
            @endcan
        </x-panel>
    </section>
@endsection
