<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Str;

class OrderCustomerPieChart extends Component
{
    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public array $series = [];

    public array $labels = [];

    public function loadData($range_dates)
    {
        $this->series = [25, 75];
        $this->labels = ['Old Customer', 'New Customer'];

        $this->dispatchBrowserEvent('refresh-chart-customer');
    }

    public function render()
    {
        $uuid = Str::uuid();

        return view('livewire.dashboard.order-customer-pie-chart', compact('uuid'));
    }
}
