<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportFile extends Model
{
    use HasFactory;

    const STATUS_PENDING = 0;

    const STATUS_PROCESSING = 1;

    const STATUS_PROCESSED = 2;

    const STATUS_FAILED = 3;

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return void
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
        $this->save();
    }

    public function isProcessed()
    {
        return $this->status == ReportFile::STATUS_PROCESSED;
    }

    /**
     * Get status as text
     *
     * @return string
     */
    public function getDisplayStatusAttribute(): string
    {
        switch($this->status) {
            case ReportFile::STATUS_PENDING: {
                return __('Pending');
            }
            case ReportFile::STATUS_PROCESSING: {
                return __('Processing');
            }            
            case ReportFile::STATUS_PROCESSED: {
                return __('Processed');
            }
            case ReportFile::STATUS_FAILED: {
                return __('Failed');
            }
        }
    }
}
