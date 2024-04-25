<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['task_name', 'total_count', 'current_count', 'report_id'];
    use HasFactory;
}
