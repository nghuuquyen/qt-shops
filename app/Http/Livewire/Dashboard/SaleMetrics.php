<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SaleMetrics extends Component
{
    protected $listeners = ['DashboardRangeDateChanged' => 'loadData'];

    public int $total_orders = 0;

    public int $total_customers = 0;

    public string $total_revenues = '0 '.Product::DEFAULT_CURRENCY;

    public string $average_spend = '0 '.Product::DEFAULT_CURRENCY;

    public function loadData($range_dates)
    {
        $data = Order::query()
            ->addSelect(DB::raw('COUNT(DISTINCT orders.id) as total_orders'))
            ->addSelect(DB::raw('COUNT(DISTINCT orders.email) as total_customers'))
            ->addSelect(DB::raw('COALESCE(SUM(cart_items.quantity * products.price), 0) as total_revenues'))

            ->leftJoin('carts', 'orders.cart_id', '=', 'carts.id')
            ->leftJoin('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->leftJoin('products', 'products.id', '=', 'cart_items.product_id')
            ->whereBetween('orders.created_at', [$range_dates['start_date'], $range_dates['end_date']])
            ->first();

        $this->total_orders = $data->total_orders;

        $this->total_customers = $data->total_customers;

        $this->total_revenues = $this->formatCurrency($data->total_revenues);

        $this->average_spend = $this->total_customers > 0
            ? $this->formatCurrency($data->total_revenues / $data->total_customers)
            : $this->formatCurrency(0);
    }

    /**
     * Format currency to display
     */
    private function formatCurrency(float $number = 0): string
    {
        return number_format($number).' '.Product::DEFAULT_CURRENCY;
    }

    public function render()
    {
        return view('livewire.dashboard.sale-metrics');
    }
}
