<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Datatable\Traits\WithSearch;

class OrderLineChart extends Component
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

    public array $data = [];

    public array $categories = [];

    public function loadData($range_dates)
    {
        $data = Order::query()
            ->addSelect(DB::raw('DATE(orders.created_at) as date'))
            ->addSelect(DB::raw('COUNT(DISTINCT orders.id) as total_orders'))
            ->whereBetween('orders.created_at', [$range_dates['start_date'], $range_dates['end_date']])
            ->groupBy('date')
            ->get();

        $this->data = $data->pluck('total_orders')->toArray();

        $this->categories = $data->pluck('date')->toArray();

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
        return view('livewire.dashboard.order-line-chart');
    }
}
