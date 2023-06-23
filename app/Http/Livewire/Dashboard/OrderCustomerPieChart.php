<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class OrderCustomerPieChart extends Component
{
    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public array $series = [];

    public array $labels = [];

    public function loadData($range_dates)
    {
        $this->series = [25, 75];

        $this->labels = ['Old Customer', 'New Customer'];

        $this->emitSelf('refresh-chart');
    }

    public function render()
    {
        return view('livewire.dashboard.order-customer-pie-chart');
    }
}
