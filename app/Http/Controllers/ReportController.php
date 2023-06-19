<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Report::class);

        return view('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Report::class);

        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Report::class);

        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'schedule' => 'required|string',
            'notify_to' => 'required|string',
        ]);

        $report = Report::factory()->create($validated);

        session()->flash('message', __('Successfully created'));

        return redirect()->route('reports.show', ['report' => $report->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        $this->authorize('view', $report);

        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        $this->authorize('update', $report);

        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        $this->authorize('update', $report);

        $validated = $request->validate([
            'title' => 'required|string',
            'type' => 'required|string',
            'schedule' => 'required|string',
            'notify_to' => 'required|string',
        ]);

        $report->title = $validated['title'];
        $report->type = $validated['type'];
        $report->schedule = $validated['schedule'];
        $report->notify_to = $validated['notify_to'];

        $report->save();

        session()->flash('message', __('Successfully updated'));

        return redirect()->route('reports.show', ['report' => $report->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        $this->authorize('delete', $report);

        $report->forceDelete();

        session()->flash('message', __('Successfully deleted'));

        return redirect()->route('reports.index');
    }
}
