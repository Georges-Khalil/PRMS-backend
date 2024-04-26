<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getProjects(Request $request)
    {
        $userId = $request->input('user_id');

        $projects = DB::table('project_members')
            ->join('projects', 'project_members.project_id', '=', 'projects.project_id')
            ->where('project_members.user_id', $userId)
            ->orderBy('projects.completion_percentage', 'asc')
            ->get();

        return response()->json($projects);
    }

    public function createProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,user_id',
            'project_title' => 'required',
            'project_description' => 'required',
            'member_emails' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $userId = $request->input('user_id');
        $user = DB::table('users')->where('user_id', $userId)->first();
        $company_code = $user->company_code;
        $member_emails = explode(',', $request->member_emails);

        // Check if all members belong to the same company as the user
        $members = DB::table('users')
        ->whereIn('email', $member_emails)
            ->where('company_code', $company_code)
            ->get();

        if (count($members) != count($member_emails)) {
            return response()->json(['error' => 'Some members do not belong to the same company as the user'], 400);
        }

        // Create the project
        $project_id = DB::table('projects')->insertGetId([
            'project_title' => $request->project_title,
            'project_description' => $request->project_description,
            'start_date' => Carbon::now(),
            'company_code' => $company_code,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Add the members to the project
        foreach ($members as $member) {
            DB::table('project_members')->insert([
                'project_id' => $project_id,
                'user_id' => $member->user_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Add the user who created the project to the project
        DB::table('project_members')->insert([
            'project_id' => $project_id,
            'user_id' => $userId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Project created successfully'], 201);
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
    public function store(StoreProjectsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projects $projects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectsRequest $request, Projects $projects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $projects)
    {
        //
    }
}
