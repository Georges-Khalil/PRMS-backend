<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TasksController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register']);
Route::get('/user/projects', [ProjectsController::class, 'getProjects']);
Route::get('/projects/{projectId}/reports', [ReportsController::class, 'getReportsByProject']);
Route::get('/reports/{reportId}/tasks', [TasksController::class, 'getTasksByReport']);
