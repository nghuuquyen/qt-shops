<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Support\Str;
use Livewire\Component;

class DateRangePicker extends Component
{
    protected $queryString = [
        'range_date' => ['except' => []],
    ];

    public $range_date;

    public string $selected_range_date = '';

    /**
     * Hook handle when updated selected_range_date properties
     *
     * @return void
     */
    public function updatedSelectedRangeDate()
    {
        $range = explode('~', $this->selected_range_date);

        $this->range_date = $this->parseRangeDate();

        $this->emit('DashboardRangeDateChanged', $this->range_date);
    }

    private function parseRangeDate(): array
    {
        $range = explode('~', $this->selected_range_date);

        return [
            'start' => $range[0],
            'end' => $range[1],
        ];
    }

    public function mount()
    {
        if ($this->range_date) {
            $this->selected_range_date = $this->range_date['start'].'~'.$this->range_date['end'];
        }
    }

    public function render()
    {
        return view('livewire.dashboard.date-range-picker');
    }
}
