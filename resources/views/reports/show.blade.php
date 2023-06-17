@extends('layouts.admin')

@section('page_title')
    {{ $report->name }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end">
        <x-button icon="arrow-uturn-left" href="{{ route('reports.index') }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to list') }}
        </x-button>

        <x-button href="{{ route('reports.edit', ['report' => $report->id]) }}" target="_self" icon="arrow-path"
            class="text-base font-normal bg-[#ea9240] hover:bg-[#ffa755]">
            {{ __('Generate Report File') }}
        </x-button>

        <x-button href="{{ route('reports.edit', ['report' => $report->id]) }}" target="_self" icon="edit"
            class="text-base font-normal ml-2">
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
                        <span>{{ $report->title }}</span>
                    </div>
                </div>

                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Type') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ Str::headline($report->type) }}</span>
                    </div>
                </div>

                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Schedule') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        <span>{{ Str::ucfirst($report->schedule) }}</span>
                    </div>
                </div>

                {{-- line attribute --}}
                <div class="grid grid-cols-5 pb-6 pt-6 items-top border-b border-on-surface-900">
                    <div class="col-span-1 text-on-surface-500 font-bold">
                        <label>{{ __('Notify To') }}</label>
                    </div>
                    <div class="col-span-4 text-on-surface-600">
                        @foreach (explode(",", $report->notify_to) as $to)
                            <span class="bg-surface-800 px-4 py-2 rounded-lg">{{ $to }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('reports.destroy', ['report' => $report->id]) }}" class="mt-5 -mr-5">
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
