<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\ReportFile;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerReportExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected ReportFile $report_file;

    /**
     * Create a new instance.
     */
    public function __construct(ReportFile $report_file)
    {
        $this->report_file = $report_file;
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Phone',
            'Email',
            'Orders',
            'Products',
            'Spent',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->full_name,
            $row->phone_number,
            $row->email,
            $row->total_order,
            $row->total_products,
            number_format($row->total_spent).' '.$row->product_currency,
        ];
    }

    public function query()
    {
        return Order::query()
            ->select([
                'full_name',
                'phone_number',
                'email',
                'products.currency AS product_currency',
            ])
            ->addSelect(DB::raw('COUNT(0) as total_order'))
            ->addSelect(DB::raw('SUM(cart_items.quantity) as total_products'))
            ->addSelect(DB::raw('SUM(cart_items.quantity * products.price) as total_spent'))
            ->leftJoin('carts', 'orders.cart_id', '=', 'carts.id')
            ->leftJoin('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->leftJoin('products', 'products.id', '=', 'cart_items.product_id')
            ->groupBy('full_name', 'phone_number', 'email')
            ->orderBy('total_spent', 'DESC')
            ->orderBy('total_order', 'DESC');
    }
}
