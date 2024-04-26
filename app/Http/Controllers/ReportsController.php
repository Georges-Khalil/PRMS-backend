<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Http\Requests\StoreReportsRequest;
use App\Http\Requests\UpdateReportsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getReportsByProject($projectId)
    {
        $reports = DB::table('reports')
        ->where('project_id', $projectId)
            ->get();

        return response()->json($reports);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'report_title' => 'required',
                'report_description' => 'required',
                'project_id' => 'required|exists:projects,project_id',
            ]);
    
            $report = Reports::create([
                'report_title' => $request->report_title,
                'report_description' => $request->report_description,
                'project_id' => $request->project_id,
                'start_date' => now(),
                'completion_percentage' => 0,
            ]);
    
            return response()->json($report, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reports $reports)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reports $reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportsRequest $request, Reports $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reports $reports)
    {
        //
    }
}
