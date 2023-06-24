<?php

namespace App\Http\Livewire\Dashboard\Charts;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderProductCategoryPieChart extends Component
{
    public $range_date;

    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public array $series = [];

    public array $labels = [];

    public function loadData($range_date)
    {
        $data = Order::query()
            ->addSelect(DB::raw('categories.name as category_name'))
            ->addSelect(DB::raw('COUNT(DISTINCT orders.id) as total_orders'))
            ->leftJoin('carts', 'orders.cart_id', '=', 'carts.id')
            ->leftJoin('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->leftJoin('products', 'products.id', '=', 'cart_items.product_id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->whereBetween('orders.created_at', [$range_date['start'], $range_date['end']])
            ->groupBy('category_name')
            ->get();

        $this->series = $data->pluck('total_orders')->toArray();

        $this->labels = $data->pluck('category_name')->toArray();

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
        return view('livewire.dashboard.order-product-category-pie-chart');
    }
}
