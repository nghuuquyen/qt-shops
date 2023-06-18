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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Report $report)
    {
        $report_file = ReportFile::factory()
            ->create([
                'report_id' => $report->id,
            ]);

        ExportReportFile::dispatch($report_file)->afterCommit();

        return redirect()->route('reports.show', ['report' => $report->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report, ReportFile $reportFile)
    {
        if (!Storage::disk(Report::REPORT_FILE_DISK)->exists($reportFile->filename)) {
            return abort(404);
        }

        return Storage::disk(Report::REPORT_FILE_DISK)->download($reportFile->filename);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report, ReportFile $reportFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report, ReportFile $reportFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report, ReportFile $reportFile)
    {
        //
    }
}
