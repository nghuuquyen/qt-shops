<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Http\Livewire\Datatable\Traits\WithSearch;

class OrderCustomerPieChart extends Component
{
    use WithSearch;

    /**
     * @var array
     */
    protected $queryString = [
        'range_dates' => ['except' => []],
    ];

    public $range_dates;

    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public array $series = [];

    public array $labels = [];

    public function loadData($range_dates)
    {
        $this->series = [25, 75];

        $this->labels = ['Old Customer', 'New Customer'];

        $this->emitSelf('refresh-chart');
    }

    public function initChart()
    {
        if ($this->range_dates) {
            $this->loadData($this->range_dates);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.order-customer-pie-chart');
    }
}
