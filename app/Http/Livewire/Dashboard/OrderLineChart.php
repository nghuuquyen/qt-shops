<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderLineChart extends Component
{
    protected $queryString = [
        'range_date' => ['except' => []],
    ];

    public $range_date;

    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public array $data = [];

    public array $categories = [];

    public function loadData($range_date)
    {
        $data = Order::query()
            ->addSelect(DB::raw('DATE(orders.created_at) as date'))
            ->addSelect(DB::raw('COUNT(DISTINCT orders.id) as total_orders'))
            ->whereBetween('orders.created_at', [$range_date['start'], $range_date['end']])
            ->groupBy('date')
            ->get();

        $this->data = $data->pluck('total_orders')->toArray();

        $this->categories = $data->pluck('date')->toArray();

        $this->emitSelf('refresh-chart');
    }

    public function initChart()
    {
        if ($this->range_date) {
            $this->loadData($this->range_date);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.order-line-chart');
    }
}
