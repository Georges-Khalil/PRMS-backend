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
            ->get();

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'task_name' => 'required',
                'total_count' => 'required|integer|min:1',
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

    public function updateCurrentCount($taskId)
    {
        try {
            $task = Tasks::findOrFail($taskId);
    
            if ($task->current_count < $task->total_count) {
                $task->increment('current_count');
            } else {
                return response()->json([
                    'message' => 'Current count cannot exceed total count',
                ], 400);
            }
    
            $report = $task->report;
            $reportTasks = $report->tasks;
            $report->completion_percentage = $reportTasks->sum('current_count') / $reportTasks->sum('total_count') * 100;
            $report->save();
    
            $project = $report->project;
            $projectReports = $project->reports;
            $project->completion_percentage = $projectReports->avg('completion_percentage');
            $project->save();
    
            return response()->json([
                'task' => $task,
                'report' => $report,
                'project' => $project,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $task = Tasks::find($id);
    
        if ($task) {
            $task->delete();
            return response()->json(['message' => 'Task deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Task not found'], 404);
        }
    }

    public function getTask($id)
    {
        $task = Tasks::find($id);
        if ($task) {
            return response()->json($task);
        } else {
            return response()->json(['error' => 'Task not found'], 404);
        }
    }

    public function updateTask(Request $request, $id)
    {
        try {
            $request->validate([
                'task_name' => 'required',
                'total_count' => 'required|integer|min:0',
                'current_count' => 'required|integer|min:0|lte:total_count',
            ]);
    
            $task = Tasks::findOrFail($id);
            $task->update($request->only(['task_name', 'total_count', 'current_count']));
            return response()->json($task);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found'], 404);
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
}
