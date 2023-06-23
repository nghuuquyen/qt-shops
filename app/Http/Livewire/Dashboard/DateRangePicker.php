<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Http\Livewire\Datatable\Traits\WithSearch;

class DateRangePicker extends Component
{
    use WithSearch;

    /**
     * @var array
     */
    protected $queryString = [
        'range_dates' => ['except' => []],
    ];

    public $range_dates;

    public string $range_date;

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

    public function mount()
    {
        if ($this->range_dates) {
            $this->range_date = $this->range_dates['start_date'] . '~' . $this->range_dates['end_date'];
        }
    }

    public function render()
    {
        $picker_id = Str::uuid();

        return view('livewire.dashboard.date-range-picker', compact('picker_id'));
    }
}
