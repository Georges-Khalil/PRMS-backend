<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['project_title', 'project_description', 'start_date', 'company_code', 'completion_percentage'];
    use HasFactory;
}
