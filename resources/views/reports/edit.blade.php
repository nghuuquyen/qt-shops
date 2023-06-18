@extends('layouts.admin')

@section('page_title')
    {{ $report->title }}
@endsection

@section('page_action')
    <div class="flex flex-row justify-end -mx-5">
        <x-button icon="arrow-uturn-left" href="{{ route('reports.show', ['report' => $report->id]) }}" target="_self"
            class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
            {{ __('Back to view') }}
        </x-button>
    </div>
@endsection

@section('main')
    <section>
        <x-panel>
            <form action="{{ route('reports.update', ['report' => $report->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="flex flex-col">
                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Title') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input name="title" value="{{ old('title', $report->title) }}"
                                placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Type') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-select name="type" value="{{ old('type', $report->type) }}">
                                <option value="" disabled>{{ __('Please choose') }}</option>
                                <option value="sale_report">Sale Report</option>
                                <option value="customer_report">Customer Report</option>
                                <option value="product_performance_report">Performance Report</option>
                            </x-select>
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Run Schedule') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-select name="schedule" value="{{ old('schedule', $report->schedule) }}">
                                <option value="" disabled>{{ __('Please choose') }}</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                            </x-select>
                        </div>
                    </div>

                    {{-- line attribute --}}
                    <div class="grid grid-cols-5 pb-6 pt-6 items-center border-b border-on-surface-900">
                        <div class="col-span-1 text-on-surface-500 font-bold">
                            <label>{{ __('Notify To') }}</label>
                        </div>
                        <div class="col-span-4 text-on-surface-600">
                            <x-text-input name="notify_to" value="{{ old('notify_to', $report->notify_to) }}"
                                placeholder="{{ __('Please input this field') }}" />
                        </div>
                    </div>
                </div>

                <div class="flex flex-row justify-end mt-10">
                    <x-button type="reset"
                        class="bg-transparent text-on-surface-500 px-0 py-0 hover:text-on-surface-600 hover:bg-transparent">
                        {{ __('Reset') }}
                    </x-button>
                    <x-button type="submit" icon="document" class="text-base font-normal">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
        </x-panel>
    </section>
@endsection
