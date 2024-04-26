<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Http\Requests\StoreTasksRequest;
use App\Http\Requests\UpdateTasksRequest;
use Illuminate\Support\Facades\DB;

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
    public function store(StoreTasksRequest $request)
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
