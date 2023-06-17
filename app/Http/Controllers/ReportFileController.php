<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportFile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ExportReportFile;
use Maatwebsite\Excel\Facades\Excel;

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
                'report_id' => $report->id
            ]);

        ExportReportFile::dispatch($report_file)->afterCommit();

        return $report_file;
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportFile $reportFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportFile $reportFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReportFile $reportFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportFile $reportFile)
    {
        //
    }
}
