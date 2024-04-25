<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'company_code'];
    use HasFactory;
}
