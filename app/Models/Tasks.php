<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['task_name', 'total_count', 'current_count', 'report_id'];
    use HasFactory;
    protected $primaryKey = 'task_id';

    public function report()
    {
        return $this->belongsTo(Reports::class, 'report_id', 'report_id');
    }
    public function attachments()
    {
        return $this->hasMany(Attachments::class, 'task_id', 'task_id');
    }
}
