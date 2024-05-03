<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['project_title', 'project_description', 'start_date', 'company_code', 'completion_percentage'];
    use HasFactory;
    protected $primaryKey = 'project_id';

    public function reports()
    {
        return $this->hasMany(Reports::class, 'project_id', 'project_id');
    }

    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_code', 'company_code');
    }

    public function users()
    {
        return $this->belongsToMany(Users::class, 'project_members', 'project_id', 'user_id');
    }
}
