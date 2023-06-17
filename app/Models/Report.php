<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    const SCHEDULE_DAILY = 'daily';
    const SCHEDULE_WEEKLY = 'weekly';

    const REPORT_FILE_DISK = 'report_files';

    const SALE_REPORT = 'sale_report';
    const PRODUCT_PERFORMANCE_REPORT = 'product_performance_report';
    const CUSTOMER_REPORT = 'customer_report';

    public function reportFiles()
    {
        return $this->hasMany(ReportFile::class);
    }
}
