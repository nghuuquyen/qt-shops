<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportFile extends Model
{
    use HasFactory;

    const STATUS_MAKING = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_PROCESSED = 2;

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
