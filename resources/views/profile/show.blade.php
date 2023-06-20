@extends('layouts.admin')

@section('page_title')
    {{ __('Settings') }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button href="{{ route('profile.edit') }}" target="_self" icon="edit" class="text-base font-normal ml-2">
            {{ __('Edit') }}
        </x-button>
    </div>
@endsection

@section('main')
    <section class="relative grid grid-cols-1 gap-6">
        <x-panel icon="cube" header="{{ __('Profile') }}">
            <livewire:users.profile-form :data="$user" mode="view" />
        </x-panel>
    </section>
@endsection
