<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Str;

class OrderProductCategoryPieChart extends Component
{
    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public array $series = [];

    public array $labels = [];

    public function loadData($range_dates)
    {
        $this->series = [25, 15, 90];
        $this->labels = ['Cafe', 'Food', 'Chicken'];

        $this->dispatchBrowserEvent('refresh-chart-category');
    }

    public function render()
    {
        $uuid = Str::uuid();

        return view('livewire.dashboard.order-product-category-pie-chart', compact('uuid'));
    }
}
