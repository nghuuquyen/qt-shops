<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'schedule',
        'notify_to',
        'last_run_at',
    ];

    protected $casts = [
        'last_run_at' => 'datetime',
    ];

    const SCHEDULE_DAILY = 'daily';
    const SCHEDULE_WEEKLY = 'weekly';

    const REPORT_FILE_DISK = 'report_files';

    const SALE_REPORT = 'sale_report';
    const PRODUCT_PERFORMANCE_REPORT = 'product_performance_report';
    const CUSTOMER_REPORT = 'customer_report';

    const DEFAULT_REPORT_TO = 'nghuuquyen@gmail.com';

    const MAXIMUM_EXPORT_FILES_PER_HOUR = 10;

    public function reportFiles()
    {
        return $this->hasMany(ReportFile::class);
    }
}
