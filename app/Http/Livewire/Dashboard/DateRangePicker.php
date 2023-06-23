<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class DateRangePicker extends Component
{
    public string $range_date = '';

    public function updatedRangeDate()
    {
        $this->emit('DashboardRangeDateChanged', $this->parseRangeDates());
    }

    /**
     * Get parsed range dates
     *
     * @return array
     */
    private function parseRangeDates(): array
    {
        $range = explode('~', $this->range_date);

        return [
            'start_date' => $range[0],
            'end_date' => $range[1],
        ];
    }

    public function render()
    {
        $picker_id = Str::uuid();

        return view('livewire.dashboard.date-range-picker', compact('picker_id'));
    }
}
