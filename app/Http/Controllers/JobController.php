<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index($id)
    {

        $singleJob = Job::find($id);

        return view('/jobs.singleJob', compact('singleJob'));
    }
}
