@extends('layouts.admin')

@section('page_title')
    {{ $mail_delivery->name }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button icon="arrow-uturn-left" href="{{ route('mail-deliveries.index') }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to list') }}
        </x-button>

        <x-button href="{{ route('mail-deliveries.edit', ['mail_delivery' => $mail_delivery->id]) }}" target="_self" icon="edit"
            class="text-base font-normal">
            {{ __('Edit') }}
        </x-button>
    </div>
@endsection

@section('main')
    <section class="relative">
        <x-panel>
            <div class="flex flex-col">
                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Title') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ $mail_delivery->title }}</span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('mail-deliveries.destroy', ['mail_delivery' => $mail_delivery->id]) }}"
                class="mt-5 -mr-5">
                @csrf
                @method('DELETE')

                <div class="flex flex-row justify-end">
                    <x-button icon="trash" type="submit"
                        class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                        {{ __('Remove this item') }}
                    </x-button>
                </div>
            </form>
        </x-panel>
    </section>
@endsection
