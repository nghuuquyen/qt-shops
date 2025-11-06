<?php

namespace App\Console\Commands;

use App\Jobs\ExportReportFile;
use App\Models\Report;
use App\Models\ReportFile;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;

class RunReportExportJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-report-export-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan and run report export jobs based on their schedule';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Scanning reports for scheduled exports...');

        $reports = $this->getReportsDueForExecution();

        if ($reports->isEmpty()) {
            $this->info('No reports due for execution.');
            return CommandAlias::SUCCESS;
        }

        $this->info("Found {$reports->count()} report(s) to process.");

        foreach ($reports as $report) {
            $this->processReport($report);
        }

        $this->info('Report export jobs dispatched successfully.');

        return CommandAlias::SUCCESS;
    }

    /**
     * Get reports that are due for execution based on their schedule
     *
     * @return Collection
     */
    private function getReportsDueForExecution()
    {
        $now = now();

        return Report::query()
            ->where(function ($query) use ($now) {
                // Daily reports: run if never run before OR last run was before today
                $query->where('schedule', Report::SCHEDULE_DAILY)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('last_run_at')
                            ->orWhere('last_run_at', '<', $now->startOfDay());
                    });
            })
            ->orWhere(function ($query) use ($now) {
                // Weekly reports: run if never run before OR last run was more than 7 days ago
                $query->where('schedule', Report::SCHEDULE_WEEKLY)
                    ->where(function ($q) use ($now) {
                        $q->whereNull('last_run_at')
                            ->orWhere('last_run_at', '<', $now->subDays(7));
                    });
            })
            ->get();
    }

    /**
     * Process a report by creating a report file and dispatching the export job
     *
     * @param Report $report
     * @return void
     */
    private function processReport(Report $report)
    {
        $this->info("Processing report: {$report->title} (Schedule: {$report->schedule})");

        try {
            // Get a system user or first admin user as the creator
            $creator = $this->getSystemUser();

            if (!$creator) {
                $this->error("No system user found. Skipping report: {$report->title}");
                return;
            }

            // Create a report file record
            $reportFile = new ReportFile();
            $reportFile->report_id = $report->id;
            $reportFile->creator_id = $creator->id;
            $reportFile->status = ReportFile::STATUS_PENDING;
            $reportFile->disk = Report::REPORT_FILE_DISK;

            // Generate filename
            $timestamp = now()->format('Y-m-d_His');
            $reportFile->filename = "{$report->type}_{$timestamp}_" . Str::random(8) . ".xlsx";

            $reportFile->save();

            // Dispatch the export job
            ExportReportFile::dispatch($reportFile);

            // Update last_run_at
            $report->last_run_at = now();
            $report->save();

            $this->info("✓ Dispatched export job for report: $report->title");
        } catch (Exception $e) {
            $this->error("✗ Failed to process report $report->title: " . $e->getMessage());
        }
    }

    /**
     * Get a system user for creating report files
     * You can customize this logic based on your requirements
     *
     * @return User|null
     */
    private function getSystemUser()
    {
        // Try to find a system user by email or get the first user
        return User::where('email', Report::DEFAULT_REPORT_TO)->first()
            ?? User::first();
    }
}
