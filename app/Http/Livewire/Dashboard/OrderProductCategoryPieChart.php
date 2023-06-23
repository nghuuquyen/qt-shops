<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrderProductCategoryPieChart extends Component
{
    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public array $series = [];

    public array $labels = [];

    public function loadData($range_dates)
    {
        $data = Order::query()
            ->addSelect(DB::raw('categories.name as category_name'))
            ->addSelect(DB::raw('COUNT(DISTINCT orders.id) as total_orders'))
            ->leftJoin('carts', 'orders.cart_id', '=', 'carts.id')
            ->leftJoin('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->leftJoin('products', 'products.id', '=', 'cart_items.product_id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->whereBetween('orders.created_at', [$range_dates['start_date'], $range_dates['end_date']])
            ->groupBy('category_name')
            ->get();

        $this->series = $data->pluck('total_orders')->toArray();

        $this->labels = $data->pluck('category_name')->toArray();

        $this->emitSelf('refresh-chart');
    }

    public function render()
    {
        return view('livewire.dashboard.order-product-category-pie-chart');
    }
}
