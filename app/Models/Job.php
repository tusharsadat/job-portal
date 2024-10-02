<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'region',
        'company_name',
        'job_type',
        'vacancy',
        'experience',
        'salary',
        'gender',
        'application_deadline',
        'job_des',
        'responsibilities',
        'education_experience',
        'other_benifits',
        'image',
    ];

    // A job belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
