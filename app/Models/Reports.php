<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $fillable = ['report_title', 'report_description', 'start_date', 'project_id', 'completion_percentage'];
    use HasFactory;
    protected $primaryKey = 'report_id';

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'report_id', 'report_id');
    }
    
    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id', 'project_id');
    }
}
