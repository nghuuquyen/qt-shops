<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class OrderCustomerPieChart extends Component
{
    public $range_date;

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
        if ($this->range_date) {
            $this->loadData($this->range_date);
        }
    }

    public function mount()
    {
        $this->range_date = request()->get('range_date');
    }

    public function render()
    {
        return view('livewire.dashboard.order-customer-pie-chart');
    }
}
