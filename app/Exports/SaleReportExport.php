<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\ReportFile;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SaleReportExport implements FromQuery, WithHeadings, WithMapping
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
            'Code',
            'Date',
            'Full Name',
            'Phone',
            'Email',
            'Shipping Address',
            'Notes',
            'Product ID',
            'Product Name',
            'Product Unit Price',
            'Quantity',
            'Total',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->code,
            $row->created_at,
            $row->full_name,
            $row->phone_number,
            $row->email,
            $row->shipping_address,
            $row->notes,
            $row->product_id,
            $row->product_name,
            number_format($row->product_price).' '.$row->product_currency,
            $row->quantity,
            number_format($row->total).' '.$row->product_currency,
        ];
    }

    public function query()
    {
        return Order::query()
            ->select([
                'code',
                'orders.created_at as created_at',
                'full_name',
                'phone_number',
                'email',
                'shipping_address',
                'orders.notes AS notes',
                'cart_items.product_id AS product_id',
                'products.name AS product_name',
                'products.price AS product_price',
                'products.currency AS product_currency',
                'cart_items.quantity AS quantity',
                DB::raw('cart_items.quantity * products.price AS total'),
            ])
            ->leftJoin('carts', 'orders.cart_id', '=', 'carts.id')
            ->leftJoin('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->leftJoin('products', 'products.id', '=', 'cart_items.product_id')
            ->latest();
    }
}
