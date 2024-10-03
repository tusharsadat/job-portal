<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index($id)
    {
        // Find the job
        $singleJob = Job::find($id);

        // Get jobs related to the same category, excluding the current job
        $relatedJobs = Job::where('category_id', $singleJob->category_id)
            ->where('id', '!=', $singleJob->id)
            ->take(5) // Limit to 5 related jobs
            ->get();

        // Count jobs related to the same category, excluding the current job
        $relatedJobCount = Job::where('category_id', $singleJob->category_id)
            ->where('id', '!=', $singleJob->id)
            ->count();


        return view('/jobs.singleJob', compact('singleJob', 'relatedJobs', 'relatedJobCount'));
    }
}
