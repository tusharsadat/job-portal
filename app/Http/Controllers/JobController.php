<?php

namespace App\Http\Controllers;

use App\Models\Application;
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

        // Verifying if user Saved the job
        $saved_job = SaveJob::where('job_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();

        // Verifying if user applied the job
        $apply_job = Application::where('job_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();

        // get all categories
        $categories = Category::all();

        return view('/jobs.singleJob', compact('singleJob', 'relatedJobs', 'relatedJobCount', 'saved_job', 'apply_job', 'categories'));
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

    public function applyJob(Request $request)
    {
        if ($request->cv == 'No CV') {
            return redirect('/jobs/singleJob/' . $request->job_id)->with('warning', 'upload your cv first');
        } else {
            $applyjob = Application::create([
                'cv' => $request->cv,
                'job_id' => $request->job_id,
                'user_id' => $request->user_id,
                'job_title' => $request->job_title,
                'region' => $request->region,
                'company_name' => $request->company_name,
                'job_type' => $request->job_type,
                'image' => $request->image,
            ]);

            if ($applyjob) {
                return redirect('/jobs/singleJob/' . $request->job_id)->with('success', 'job apply successfully');
            }
        }
    }
}
