<?php

namespace App\Jobs;

use App\Exports\CustomerReportExport;
use App\Exports\ProductPerformanceReportExport;
use App\Exports\SaleReportExport;
use App\Models\Report;
use App\Models\ReportFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportReportFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected ReportFile $report_file;

    /**
     * Create a new job instance.
     */
    public function __construct(ReportFile $report_file)
    {
        $this->report_file = $report_file;
    }

    /**
     * Get export file name
     */
    private function getExportFileName(): string
    {
        return $this->report_file->filename;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $filename = $this->getExportFileName();

        $disk = Report::REPORT_FILE_DISK;

        switch ($this->report_file->report->type) {
            case Report::SALE_REPORT:
                Excel::store(new SaleReportExport($this->report_file), $filename, $disk);
                break;

            case Report::PRODUCT_PERFORMANCE_REPORT:
                Excel::store(new ProductPerformanceReportExport($this->report_file), $filename, $disk);
                break;

            case Report::CUSTOMER_REPORT:
                Excel::store(new CustomerReportExport($this->report_file), $filename, $disk);
                break;
        }
    }
}
