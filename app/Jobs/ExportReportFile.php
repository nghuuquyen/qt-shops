<?php

namespace App\Jobs;

use DateTime;
use Exception;
use App\Models\Report;
use App\Models\ReportFile;
use Illuminate\Bus\Queueable;
use App\Exports\SaleReportExport;
use App\Events\ReportFileCompleted;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomerReportExport;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\Middleware\RateLimited;
use App\Exports\ProductPerformanceReportExport;

class ExportReportFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public ReportFile $report_file;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public $maxExceptions = 3;

    /**
     * Delete the job if its models no longer exist.
     *
     * @var bool
     */
    public $deleteWhenMissingModels = true;

    /**
     * Determine the time at which the job should timeout.
     */
    public function retryUntil(): DateTime
    {
        return now()->addMinutes(15);
    }

    /**
     * Get the middleware the job should pass through.
     *
     * @return array<int, object>
     */
    public function middleware(): array
    {
        return [(new RateLimited('export-report-files'))->dontRelease()];
    }

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
        try {
            $this->report_file->setStatus(ReportFile::STATUS_PROCESSING);

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

            $this->report_file->setStatus(ReportFile::STATUS_PROCESSED);

            ReportFileCompleted::dispatch($this->report_file);

        } catch (Exception $e) {
            $this->report_file->setStatus(ReportFile::STATUS_FAILED);
        }
    }
}
