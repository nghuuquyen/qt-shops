<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\ReportFile;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductPerformanceReportExport implements FromQuery, WithHeadings, WithMapping
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
            'Product ID',
            'Product Name',
            'Category',
            'Product Unit Price',
            'Total Orders',
        ];
    }

    public function map(mixed $row): array
    {
        return [
            $row->id,
            $row->name,
            $row->full_name,
            $row->category->name,
            number_format($row->price).' '.$row->currency,
            $row->total_orders,
        ];
    }

    public function query()
    {
        return Product::query()->with('category')
            ->select('*')
            ->addSelect(DB::raw('
            (
                SELECT
                    COUNT(DISTINCT orders.id)
                FROM cart_items
                JOIN carts ON cart_items.cart_id = carts.id
                JOIN orders ON carts.id = orders.cart_id
                WHERE cart_items.product_id = products.id
            ) as total_orders'
            ));
    }
}
