<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachments extends Model
{
    protected $fillable = ['task_id', 'file_name', 'file_data', 'file_type', 'file_size', 'uploaded_by_user_id', 'upload_date'];
    use HasFactory;
    public function task()
    {
        return $this->belongsTo(Tasks::class, 'task_id', 'task_id');
    }
}
