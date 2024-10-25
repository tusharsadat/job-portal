<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv',
        'user_email',
        'job_id',
        'user_id',
        'job_title',
        'region',
        'company_name',
        'job_type',
        'image',
    ];
}
