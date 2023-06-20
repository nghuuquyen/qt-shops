@extends('layouts.admin')

@section('page_title')
    {{ __('Edit Profile') }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button icon="arrow-uturn-left" href="{{ route('profile.show') }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to view') }}
        </x-button>
    </div>
@endsection


@section('main')
    <section>
        <x-panel icon="cube">
            <livewire:users.profile-form :data="$user" mode="edit" />
        </x-panel>
    </section>
@endsection
