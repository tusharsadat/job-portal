<?php

namespace App\Http\Controllers;

use App\Models\Job;

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
        // Get all unique region values from the jobs table
        $regions = Job::select('region')->distinct()->get();

        $latestJobs = Job::latest()->take(5)->get();
        $jobCount = Job::count();

        return view('/home', compact('jobCount', 'latestJobs', 'regions'));
    }
}
