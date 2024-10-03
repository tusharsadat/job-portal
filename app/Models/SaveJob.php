<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'job_title',
        'region',
        'company_name',
        'job_type',
        'image',
    ];
}
