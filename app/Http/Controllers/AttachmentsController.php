<?php

namespace App\Http\Controllers;

use App\Models\Attachments;
use App\Http\Requests\StoreAttachmentsRequest;
use App\Http\Requests\UpdateAttachmentsRequest;
use App\Models\Tasks;
use Illuminate\Http\Request;

class AttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getAttachments($taskId)
    {
        try {
            $task = Tasks::findOrFail($taskId);
            $attachments = $task->attachments;
    
            return response()->json([
                'attachments' => $attachments,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
        }
    }

    public function addAttachment(Request $request, $taskId)
    {
        try {
            $task = Tasks::findOrFail($taskId);
    
            $file = $request->file('file_data');
            $fileContent = file_get_contents($file);
    
            $attachment = new Attachments;
            $attachment->task_id = $task->task_id;
            $attachment->file_name = $request->file_name;
            $attachment->file_data = base64_encode($fileContent); // store file data as base64
            $attachment->file_type = $request->file_type;
            $attachment->file_size = $request->file_size;
            $attachment->uploaded_by_user_id = $request->uploaded_by_user_id;
            $attachment->upload_date = now();
            $attachment->save();
    
            return response()->json([
                'message' => 'Attachment added successfully',
                'attachment' => $attachment,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found',
            ], 404);
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
     * Store a newly created resource in storage.
     */
    public function store(StoreAttachmentsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attachments $attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attachments $attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttachmentsRequest $request, Attachments $attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachments $attachments)
    {
        //
    }
}
