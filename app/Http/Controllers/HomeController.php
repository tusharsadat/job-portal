<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Search;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Build the query to get the latest 5 keywords where the length is greater than 1
        $keywords = Search::select('keyword')
            ->whereRaw('LENGTH(keyword) > 1')  // Keywords longer than one character
            ->groupBy('keyword')
            ->havingRaw('COUNT(*) > 1')  // Only get keywords that appear more than once
            ->orderByRaw('MAX(created_at) desc')  // Order by the most recent occurrence
            ->limit(5)
            ->get();

        // Get all unique region values from the jobs table
        $regions = Job::select('region')->distinct()->get();

        $latestJobs = Job::latest()->take(5)->get();
        $jobCount = Job::count();

        return view('/home', compact('jobCount', 'latestJobs', 'regions', 'keywords'));
    }

    public function searchJobs(Request $request)
    {
        $request->validate([
            'job_title' => 'required',
            'region' => 'required',
            'job_type' => 'required',
        ]);

        $search_keyword = Search::create([
            'keyword' => $request->job_title
        ]);

        // Get the search inputs from the request
        $jobTitle = $request->input('job_title');
        $region = $request->input('region');
        $jobType = $request->input('job_type');

        // Build the query
        $query = Job::query();

        // Apply filters based on the input
        if (!empty($jobTitle)) {
            $query->where('job_title', 'LIKE', '%' . $jobTitle . '%');
        }

        if (!empty($region)) {
            $query->where('region', 'LIKE', '%' . $region . '%');
        }

        if (!empty($jobType)) {
            $query->where('job_type', $jobType);
        }

        // Execute the query and paginate the results (optional)
        $jobs = $query->paginate(10);

        // Return the results to the view (or as a JSON response for an API)
        return view('jobs.search', compact('jobs'));
    }
}
