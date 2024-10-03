<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\SaveJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Saved job
        $saved_job = SaveJob::where('job_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();


        return view('/jobs.singleJob', compact('singleJob', 'relatedJobs', 'relatedJobCount', 'saved_job'));
    }

    public function singleJobSave(Request $request)
    {
        $savejob = SaveJob::create([
            'job_id' => $request->job_id,
            'user_id' => $request->user_id,
            'job_title' => $request->job_title,
            'region' => $request->region,
            'company_name' => $request->company_name,
            'job_type' => $request->job_type,
            'image' => $request->image,
        ]);

        if ($savejob) {
            return redirect('/jobs/singleJob/' . $request->job_id)->with('success', 'job saved successfully');
        }
    }
}
