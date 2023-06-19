@extends('layouts.admin')

@section('page_title')
    {{ __('Settings') }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button href="{{ route('profile.edit') }}" target="_self" icon="edit"
            class="text-base font-normal ml-2">
            {{ __('Edit') }}
        </x-button>
    </div>
@endsection

@section('main')
    <section class="relative grid grid-cols-1 gap-6">
        <x-panel icon="cube" header="{{ __('Profile') }}">
            <div class="flex flex-col">
                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Name') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ $user->name }}</span>
                    </div>
                </div>

                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Email') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ $user->email }}</span>
                    </div>
                </div>
            </div>
        </x-panel>
    </section>
@endsection
