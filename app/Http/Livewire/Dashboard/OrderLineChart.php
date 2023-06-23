<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class OrderLineChart extends Component
{
    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public function loadData($range_dates)
    {

    }

    public function render()
    {
        return view('livewire.dashboard.order-line-chart');
    }
}
