<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getTasksByReport($reportId)
    {
        $tasks = DB::table('tasks')
        ->leftJoin('attachments', 'tasks.task_id', '=', 'attachments.task_id')
        ->where('tasks.report_id', $reportId)
            ->select('tasks.*', 'attachments.file_name', 'attachments.file_type', 'attachments.file_size')
            ->orderBy('tasks.current_count', 'asc')
            ->get();

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'task_name' => 'required',
                'total_count' => 'required|integer',
                'report_id' => 'required|exists:reports,report_id',
            ]);

            $task = Tasks::create([
                'task_name' => $request->task_name,
                'total_count' => $request->total_count,
                'report_id' => $request->report_id,
                'current_count' => 0,
            ]);

            return response()->json($task, 201);
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
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTasksRequest $request, Tasks $tasks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tasks $tasks)
    {
        //
    }
}
