<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportFile;
use Illuminate\Http\Request;
use App\Jobs\ExportReportFile;
use Illuminate\Support\Facades\Storage;

class ReportFileController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Report $report)
    {
        $this->authorize('create', $report);

        $report_file = ReportFile::factory()
            ->create([
                'report_id' => $report->id,
                'creator_id' => auth()->user()->id,
            ]);

        ExportReportFile::dispatch($report_file)->afterCommit();

        session()->flash('message', __('Successfully created'));
    
        return redirect()->route('reports.show', ['report' => $report->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report, ReportFile $reportFile)
    {
        $this->authorize('view', $report);

        if (!Storage::disk(Report::REPORT_FILE_DISK)->exists($reportFile->filename)) {
            return abort(404);
        }

        return Storage::disk(Report::REPORT_FILE_DISK)->download($reportFile->filename);
    }
}
