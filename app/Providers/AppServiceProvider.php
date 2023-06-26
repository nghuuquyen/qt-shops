<?php

namespace App\Providers;

use App\Models\Report;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // only allow process maximum 10 export files per hours for each report
        RateLimiter::for('export-report-files', function (object $job) {
            return Limit::perHour(Report::MAXIMUM_EXPORT_FILES_PER_HOUR)->by($job->report_file->report->id);
        });
    }
}
